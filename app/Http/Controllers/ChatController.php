<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mood;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\GeminiService;
use Illuminate\Support\Str; 

class ChatController extends Controller
{
    // new chat 
    public function newChat()
    {
        $conversation_id = Str::uuid();

        return response()->json([
            'conversation_id' => $conversation_id
        ]);
    }

    // send msgs
    public function sendMessage(Request $request)
    {
        $userMessage = $request->message;

        $gemini = new GeminiService();
        $botReply = $gemini->generateResponse($userMessage);

        // 
        $userId = Auth::id();

        $conversationId = $request->conversation_id ?? uniqid();

        // FIX: guests have no saved messages, so always treat as first message for guests
        $isFirstMessage = $userId
            ? !Message::where('conversation_id', $conversationId)->exists()
            : false;

        $title = null;

        if ($userId && $isFirstMessage) {
            $title = substr($userMessage, 0, 30);
        }

     
        if ($userId) {
            $msg = Message::create([
                'user_id'         => $userId,
                'conversation_id' => $conversationId,
                'message'         => $userMessage,
                'reply'           => $botReply,
                'title'           => $title
            ]);

            \Log::info("SAVED MESSAGE ID: " . $msg->id);
        }

        return response()->json([
            'reply'           => $botReply,
            'conversation_id' => $conversationId
        ]);
    }

    // get msgs
    public function getMessages($id)
    {
        return Chat::where('conversation_id', $id)->get();
    }

    // sidebar conversation
    public function getConversations()
    {
        return Chat::where('user_id', auth()->id())
            ->select('conversation_id')
            ->distinct()
            ->latest()
            ->get();
    }

    // chat history
    public function chatHistory(Request $request)
    {
        if (!Auth::check()) {
            // FIX: return empty array for guests (not wrapped object)
            return response()->json([]);
        }

        $conversationId = $request->conversation_id ?? 'default_thread';

        $messages = Message::where('user_id', Auth::id())
            ->where('conversation_id', $conversationId)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    // recent threads
    public function recentThreads()
    {
        if (!Auth::check()) {
            return response()->json([]);
        }

        $threads = Message::where('user_id', Auth::id())
            ->whereNotNull('conversation_id')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('conversation_id')
            ->map(function ($msgs) {
                $first = $msgs->first();

                return [
                    'conversation_id' => $first->conversation_id,
                    'title'           => $first->title ?? substr($first->message, 0, 30),
                ];
            })
            ->values();

        return response()->json($threads);
    }

    // save mood
    public function saveMood(Request $request)
    {
        // FIX: removed hardcoded ?? 1, guests get null user_id
        // make sure moods.user_id is nullable in your migration
        Mood::create([
            'user_id' => Auth::id(),
            'mood'    => $request->mood
        ]);

        return response()->json(['status' => 'saved']);
    }

    // get moods
    public function getMoods()
    {
        if (!auth()->check()) {
            return response()->json([]);
        }

        return Mood::where('user_id', auth()->id())
            ->latest()
            ->take(10)
            ->get();
    }

 public function renameThread(Request $request)
{
    if (!Auth::check()) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // conversation ke pehle message ka title update karo
    Message::where('conversation_id', $request->conversation_id)
        ->where('user_id', Auth::id())
        ->update(['title' => $request->title]);

    return response()->json(['success' => true]);
}

public function deleteThread(Request $request)
{
    if (!Auth::check()) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // conversation ke saare messages delete karo
    Message::where('conversation_id', $request->conversation_id)
        ->where('user_id', Auth::id())
        ->delete();

    return response()->json(['success' => true]);
}
}