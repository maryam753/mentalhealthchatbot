<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mindmate Chatbot</title>
    <link rel="stylesheet" href="{{ asset('css/bot.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<!-- Mobile sidebar toggle (hamburger) -->
<button class="sidebar-toggle" id="sidebarToggle" aria-label="Open menu">
    <svg viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
</button>

<!-- Overlay (tap to close sidebar on mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="chat-container">

    <!-- LEFT SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <!-- Logo -->
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="elybun">
            <div>
                <h2>ElyBun</h2>
            </div>
        </div>

        <!-- New Chat Button -->
        <button class="new-chat-btn" id="newChatBtn">New Chat</button>

        <!-- Mood Widget -->
        <div class="mood-widget">
            <p class="mood-widget-label">How are you today?</p>
            <div class="mood-faces">
                <span class="mood-face">😞</span>
                <span class="mood-face">😐</span>
                <span class="mood-face active">🙂</span>
                <span class="mood-face">😄</span>
            </div>
        </div>

        <!-- Recent sessions label -->
        <p class="recent-label">Recent sessions</p>

        <!-- Recent Threads -->
        <div id="recentThreads">
            <!-- Recent threads will load here dynamically -->
        </div>

        <!-- User Box -->
        <div class="user-box" id="userMenu">
            <div class="user-icon">U</div>

            <div class="user-info">
                @auth
                    <p class="user-name">{{ Auth::user()->name }}</p>
                    <p class="user-role">Member</p>
                @endauth
                @guest
                    <p class="user-name">Guest User</p>
                    <p class="user-role">Free plan</p>
                @endguest
            </div>

           

            <!-- Dropdown -->
            <div class="user-dropdown" id="userDropdown">
                @guest
                    <a href="javascript:void(0)"
                       class="dropdown-link"
                       data-bs-toggle="modal"
                       data-bs-target="#loginModal">
                        🔐 Login
                    </a>
                @endguest

                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-btn">Logout</button>
                    </form>
                @endauth
            </div>
        </div>

    </aside>

    <!-- LOGIN MODAL -->
    <div class="modal fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content login-card">
                <div class="card-banner">
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                    <div class="banner-logo">
                        <img src="{{ asset('img/logo.png') }}" alt="ElyBun">
                    </div>
                    <h2>Welcome back</h2>
                    <p>Sign in to continue your journey with ElyBun</p>
                </div>
                <div class="card-body-inner">
                    <div class="social-row">
                        <a href="/auth/google" class="btn btn-danger w-100">
                            <i class="fab fa-google me-2"></i> Google
                        </a>
                       <a href="{{ route('github.login') }}" class="social-btn">
                     <i class="fab fa-github"></i> GitHub
                         </a>
                    </div>
                    <div class="divider"><span>or continue with email</span></div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" required class="form-control mb-3" placeholder="you@example.com">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" required class="form-control mb-3" placeholder="Enter your password">
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Sign In →</button>
                    </form>
                    <p class="text-center mt-3 small">
                        Don't have an account? <a href="#" id="openRegister">Create one free</a>
                    </p>
                    <p class="text-center text-muted small mt-1">
                        By continuing, you agree to our Terms &amp; Privacy Policy
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- REGISTER MODAL -->
    <div class="modal fade" id="registerModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content login-card">
                <div class="card-banner">
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                    <div class="banner-logo">
                        <img src="{{ asset('img/logo.png') }}" alt="ElyBun">
                    </div>
                    <h2>Create your account</h2>
                    <p>Start your mental wellness journey today</p>
                </div>
                <div class="card-body-inner">
                    @if ($errors->any())
                        <div style="color:red;">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control mb-3" placeholder="Your full name" required>
                        </div>
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" class="form-control mb-3" placeholder="you@example.com" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control mb-3" placeholder="Min. 8 characters" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control mb-3" placeholder="Repeat your password" required>
                        </div>
                        <button class="btn btn-dark w-100">Create Account →</button>
                    </form>
                    <p class="text-center mt-3 small">
                        Already have an account? <a href="#" id="openLogin">Sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN CHAT AREA -->
    <main class="chat-area">

        <!-- Chat Header -->
        <div class="chat-header">
            <div class="chat-header-left">
                <div class="bot-avatar-header">
                    <img src="{{ asset('img/logo.png') }}" alt="ElyBun">
                </div>
                <div>
                    <p class="header-bot-name">ElyBun</p>
                    <p class="header-bot-status">Online</p>
                </div>
            </div>
            <div class="chat-header-right">
              <span class="header-badge" data-bs-toggle="modal" data-bs-target="#moodModal">
                Mood log
              </span>
               <button class="helpline-btn" data-bs-toggle="modal" data-bs-target="#helplineModal">
                🆘 Help
            </button>
            </div>
        </div>

        <!-- Message Display Section -->
        <div id="messageDisplaySection">
            {{-- Welcome message is injected by JS after chat history loads --}}
        </div>

        <!-- Quick Reply Chips -->
        <div class="quick-replies" id="quickReplies">
            <span class="quick-reply-chip" data-msg="I'm feeling anxious">😰 Feeling anxious</span>
            <span class="quick-reply-chip" data-msg="I need to vent">💬 Need to vent</span>
            <span class="quick-reply-chip" data-msg="Help me calm down">🌿 Help me calm down</span>
        </div>

        <!-- Chat Input -->
        <div class="chat-input-box">
            <div class="input-inner">
                <input id="messages" type="text" placeholder="What's on your mind?">
                <div class="input-actions">
                      <button onclick="startListening()" class="mic-btn">🎤</button>
                    <button id="send" class="send-btn" style="display:none;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none">
                            <path d="M22 2L11 13M22 2L15 22l-4-9-9-4 20-7z" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>
            <p class="input-disclaimer">ElyBun is not a substitute for professional therapy. In crisis, call 1122.</p>
        </div>

    </main>

</div>
<!-- MOOD MODAL -->
<div class="modal fade" id="moodModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content mood-modal-card">

            <!-- Banner -->
            <div class="mood-modal-banner">
                <button class="btn-close" data-bs-dismiss="modal"></button>
                <span class="mood-modal-icon">📊</span>
                <h4>Mood Journal</h4>
                <p>Your emotional wellness over time</p>
                <div class="mood-summary" id="moodSummary"></div>
            </div>

            <!-- Body -->
            <div class="mood-modal-body">
                <div id="moodList"></div>
                <p class="mood-empty" id="moodEmpty" style="display:none;">
                    No mood entries yet — Login to track mood  🌱
                </p>
            </div>

        </div>
    </div>
</div>
<!-- HELPLINE MODAL -->
<div class="modal fade" id="helplineModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content helpline-card">
            <div class="helpline-banner">
                <button class="btn-close" data-bs-dismiss="modal"></button>
                <span class="helpline-heart">🤍</span>
                <h4>You're not alone</h4>
                <p>Reach out — a real person is ready to listen</p>
            </div>
            <div class="helpline-body">
                <div class="helpline-list">
                    <div class="helpline-item">
                        <div class="helpline-icon hi-blue">🇵🇰</div>
                        <div>
                            <strong>Pakistan – Umang</strong>
                            <p>📞 1093 &nbsp;·&nbsp; Free &amp; Confidential</p>
                        </div>
                    </div>
                    <div class="helpline-item">
                        <div class="helpline-icon hi-green">💚</div>
                        <div>
                            <strong>Pakistan – Taskeen</strong>
                            <p>📞 042-35761999</p>
                        </div>
                    </div>
                    <div class="helpline-item">
                        <div class="helpline-icon hi-purple">🌐</div>
                        <div>
                            <strong>International – Befrienders</strong>
                            <p>www.befrienders.org</p>
                        </div>
                    </div>
                    <div class="helpline-item">
                        <div class="helpline-icon hi-red">🚨</div>
                        <div>
                            <strong>Local Emergency</strong>
                            <p>📞 Dial your local emergency number</p>
                        </div>
                    </div>
                </div>
                <p class="text-center small text-muted mt-3">Talking to someone can make a real difference 💜</p>
            </div>
        </div>
    </div>
</div>

<div class="delete-modal-overlay" id="deleteModalOverlay">
    <div class="delete-modal">
        <div class="delete-modal-top">
            <div class="delete-modal-icon">🗑️</div>
            <h3>Delete this chat?</h3>
            <p>This chat will delete permanently.Are you sure?</p>
        </div>
        <div class="delete-modal-body">
            <button class="btn-delete-confirm" id="confirmDeleteBtn">Delete </button>
            <button class="btn-delete-cancel" id="cancelDeleteBtn">Cancel</button>
        </div>
    </div>
</div>
<!-- js -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
window.newChat = function () {
    $.ajax({
        url: '/new-chat',
        type: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(res) {
            currentConversationId = res.conversation_id;
            console.log("New Chat ID:", currentConversationId);
        },
        error: function(xhr) {
            console.error("new-chat error:", xhr.status, xhr.statusText);
        }
    });
};
</script>

<script>
    let isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
    let currentConversationId = null;
    let isVoiceInput = false;

    // Helpline button placeholder ko actual button mein convert karta hai
    function injectHelplineButton(html) {
        const helplineBtn = `<div class="mt-2">
            <button class="helpline-btn" style="font-size:13px; padding:6px 14px;"
                data-bs-toggle="modal" data-bs-target="#helplineModal">
                🆘 View Helplines
            </button>
        </div>`;
        return html.replace('[HELPLINE_BUTTON]', helplineBtn);
    }

    $(document).ready(function() {

        // ── Mobile sidebar toggle ──
        $('#sidebarToggle').on('click', function() {
            $('#sidebar').addClass('open');
            $('#sidebarOverlay').addClass('show');
        });
        $('#sidebarOverlay').on('click', function() {
            $('#sidebar').removeClass('open');
            $(this).removeClass('show');
        });
        // Close sidebar when a thread is tapped on mobile
        $(document).on('click', '.thread-item', function() {
            if (window.innerWidth <= 640) {
                $('#sidebar').removeClass('open');
                $('#sidebarOverlay').removeClass('show');
            }
        });

        {{-- FIX: replaced bare $.post with $.ajax so CSRF header is sent for guests --}}
        $.ajax({
            url: '/new-chat',
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(res) {
                currentConversationId = res.conversation_id;

                $.ajax({
                    url: "/chat-history",
                    type: "GET",
                    data: { conversation_id: currentConversationId },
                    success: function(data) {
                        $("#messageDisplaySection").empty();
                        if(Array.isArray(data) && data.length > 0){
                            // user has existing history — load it
                            data.forEach(function(msg){
                                appendUserMessage(msg.message ?? '');
                                if(msg.reply){
                                    appendBotMessage(marked.parse(msg.reply ?? ''));
                                }
                            });
                            scrollToBottom();
                        } else {
                            // guest OR no history  show welcome message
                            appendBotMessage('<p>Hi there! 👋</p><p>I\'m ElyBun, and I\'m here to listen. What happened today? 😊</p>');
                        }
                    },
                    error: function() {
                        // fallback on any error  always show welcome
                        $("#messageDisplaySection").empty();
                        appendBotMessage('<p>Hi there! 👋</p><p>I\'m ElyBun, and I\'m here to listen. What happened today? 😊</p>');
                    }
                });
            },
            error: function(xhr) {
                // new-chat itself failed  still show welcome
                appendBotMessage('<p>Hi there! 👋</p><p>I\'m ElyBun, and I\'m here to listen. What happened today? 😊</p>');
                console.error("new-chat init error:", xhr.status, xhr.statusText);
            }
        });

       function loadRecentThreads() {
    $.ajax({
        url: "/recent-threads",
        type: "GET",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        xhrFields: { withCredentials: true },
        success: function(data) {
            let container = $("#recentThreads");
            container.empty();
            if (Array.isArray(data) && data.length) {
                data.forEach(thread => {
                    let convId = thread.conversation_id;
                    let title = thread.title ?? 'New Chat';
                    let isActive = (convId === currentConversationId) ? 'active' : '';
                    container.append(`
                        <div class="thread-item ${isActive}" data-conversation-id="${convId}">
                            <span class="thread-title">💬 ${title}</span>
                            <div class="thread-actions">
                                <button class="thread-action-btn rename-btn" data-id="${convId}" title="Rename">✏️</button>
                                <button class="thread-action-btn delete-btn" data-id="${convId}" title="Delete">🗑️</button>
                            </div>
                        </div>
                    `);
                });
            } else {
                container.append('<p style="font-size:11px; color:rgba(255,255,255,0.4); padding:8px 12px;">No threads yet</p>');
            }
        },
        error: function(xhr){ console.error('Error loading threads:', xhr.statusText); }
    });
}

        loadRecentThreads();
        //  Rename button click 
$(document).on('click', '.rename-btn', function(e) {
    e.stopPropagation();
    let btn = $(this);
    let threadItem = btn.closest('.thread-item');
    let convId = btn.data('id');
    let currentTitle = threadItem.find('.thread-title').text().replace('💬 ', '').trim();

    // Replace title with input
    threadItem.find('.thread-title').html(
        `<input class="thread-rename-input" value="${currentTitle}" maxlength="60" />`
    );
    threadItem.find('.thread-rename-input').focus().select();
});

//  Save rename on Enter or blur 
$(document).on('keydown blur', '.thread-rename-input', function(e) {
    if (e.type === 'keydown' && e.key !== 'Enter') return;
    let input = $(this);
    let newTitle = input.val().trim() || 'New Chat';
    let threadItem = input.closest('.thread-item');
    let convId = threadItem.data('conversation-id');

    $.ajax({
        url: '/rename-thread',
        type: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: { conversation_id: convId, title: newTitle },
        success: function() { loadRecentThreads(); },
        error: function() { loadRecentThreads(); }
    });
});

let pendingDeleteId = null;

// Delete button click  custom modal open karo
$(document).on('click', '.delete-btn', function(e) {
    e.stopPropagation();
    pendingDeleteId = $(this).data('id');
    $('#deleteModalOverlay').addClass('show');
});

// Cancel
$('#cancelDeleteBtn').on('click', function() {
    pendingDeleteId = null;
    $('#deleteModalOverlay').removeClass('show');
});

// Overlay pe click 
$('#deleteModalOverlay').on('click', function(e) {
    if ($(e.target).is('#deleteModalOverlay')) {
        pendingDeleteId = null;
        $('#deleteModalOverlay').removeClass('show');
    }
});

// Confirm delete
$('#confirmDeleteBtn').on('click', function() {
    if (!pendingDeleteId) return;
    let convId = pendingDeleteId;
    $('#deleteModalOverlay').removeClass('show');
    pendingDeleteId = null;

    $.ajax({
        url: '/delete-thread',
        type: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: { conversation_id: convId },
        success: function() {
            if (currentConversationId === convId) {
                currentConversationId = null;
                $("#messageDisplaySection").empty();
                appendBotMessage('<p>Hi there! 👋</p><p>I\'m ElyBun, and I\'m here to listen. What happened today? 😊</p>');
            }
            loadRecentThreads();
        },
        error: function(xhr) { console.error('Delete error:', xhr.statusText); }
    });
});
        $(document).on('click', '.thread-item', function() {
             $('.thread-item').removeClass('active');
    $(this).addClass('active');
            let conversationId = $(this).data('conversation-id');
            currentConversationId = conversationId;
            $("#messageDisplaySection").empty();
            $.ajax({
                url: "/chat-history",
                type: "GET",
                data: { conversation_id: conversationId },
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(data){
                    if(Array.isArray(data)){
                        data.forEach(function(msg){
                            appendUserMessage(msg.message ?? '');
                            if(msg.reply){
                                appendBotMessage(marked.parse(msg.reply ?? ''));
                            }
                        });
                        scrollToBottom();
                    }
                },
                error: function(xhr){ console.error('Error loading chat for thread:', xhr.statusText); }
            });
        });

        // New chat click
        $("#newChatBtn").click(function(){
            currentConversationId = null;
            {{-- FIX: replaced $.post with $.ajax for CSRF header --}}
            $.ajax({
                url: '/new-chat',
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(res) {
                    currentConversationId = res.conversation_id;
                    loadRecentThreads();
                },
                error: function(xhr) {
                    console.error("new-chat btn error:", xhr.status, xhr.statusText);
                }
            });
            $("#messageDisplaySection").empty();
            appendBotMessage('<p>Hi there! 👋</p><p>I\'m ElyBun, and I\'m here to listen. What happened today? 😊</p>');
            scrollToBottom();
        });

        // Quick reply chips
        $(document).on('click', '.quick-reply-chip', function(){
            let msg = $(this).data('msg');
            if(msg){
                $("#messages").val(msg);
                $("#send").fadeIn(100);
                $("#send").click();
            }
        });

        // Input show/hide send button
        $("#messages").on("input", function () {
            let value = $(this).val().trim();
            if (value.length > 0) {
                $("#send").stop(true, true).fadeIn(100);
            } else {
                $("#send").stop(true, true).fadeOut(100);
            }
        });

        $("#messages").on("keydown", function (event) {
            if (event.key === "Enter") {
                event.preventDefault();
                $("#send").click();
            }
        });

        function scrollToBottom() {
            let section = document.getElementById("messageDisplaySection");
            section.scrollTop = section.scrollHeight;
        }

        function appendUserMessage(text) {
            $("#messageDisplaySection").append(
                `<div class="chat usersMessages">
                    <div class="bubble">${text}</div>
                </div>`
            );
        }

        function appendBotMessage(html) {
            // [HELPLINE_BUTTON] placeholder ko real button mein convert karo
            html = injectHelplineButton(html);

            let logoUrl = "{{ asset('img/logo.png') }}";
            $("#messageDisplaySection").append(
                `<div class="chat botMessages">
                    <div class="bot-avatar-sm">
                        <img src="${logoUrl}" alt="ElyBun">
                    </div>
                    <div class="bot-content">
                        <div class="bubble">${html}</div>
                    </div>
                </div>`
            );
            let tempDiv = document.createElement("div");
            tempDiv.innerHTML = html;
            let cleanText = tempDiv.innerText;
            if (isVoiceInput) {
                speak(cleanText);
                isVoiceInput = false;
            }
        }

        // Send message
        $("#send").click(function() {
            let userMessage = $("#messages").val().trim();
            if (userMessage === "") return;

            if (!isLoggedIn) {
                console.log("Guest mode: chat will not be saved");
            }

            appendUserMessage(userMessage);

            // Typing indicator
            let logoUrl = "{{ asset('img/logo.png') }}";
            let typingHtml = `
                <div class="chat typing-indicator" id="typingIndicator">
                    <div class="bot-avatar-sm">
                        <img src="${logoUrl}" alt="ElyBun">
                    </div>
                    <div class="bubble">
                        <div class="typing-dots">
                            <span></span><span></span><span></span>
                        </div>
                    </div>
                </div>`;
            $("#messageDisplaySection").append(typingHtml);

            scrollToBottom();

            $.ajax({
                url: "/send-message",
                type: "POST",
                data: {
                    message: userMessage,
                    conversation_id: currentConversationId
                },
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                xhrFields: { withCredentials: true },
                success: function(data) {
                    $("#typingIndicator").remove();
                    let reply = data.reply || "⚠️ No response from server";
                    let formattedReply = reply ? marked.parse(reply) : "";
                    appendBotMessage(formattedReply);
                    scrollToBottom();
                    loadRecentThreads();
                },
                error: function(xhr) {
                    $("#typingIndicator").remove();
                    appendBotMessage("<p>⚠️ Something went wrong. Please try again.</p>");
                    scrollToBottom();
                    console.error("send-message error:", xhr.status, xhr.responseText);
                }
            });

            $("#messages").val("");
            $("#send").hide();
        });

    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function () {

    // MOOD FACE TOGGLE
    $('.mood-face').on('click', function(){
        $('.mood-face').removeClass('active');
        $(this).addClass('active');

        let mood = $(this).text();

        $.post('/save-mood', {
            mood: mood,
            _token: $('meta[name="csrf-token"]').attr('content')
        });
    });

    // REGISTER CLICK
    $('#openRegister').click(function (e) {
        e.preventDefault();
        document.activeElement.blur();
        $('#loginModal').modal('hide');
        setTimeout(function () { $('#registerModal').modal('show'); }, 300);
    });
    // LOGIN CARD
    $('#openLogin').click(function (e) {
        e.preventDefault();
        document.activeElement.blur();
        $('#registerModal').modal('hide');
        setTimeout(function () { $('#loginModal').modal('show'); }, 300);
    });

    $("#userMenu").on("click", function (e) {
        e.stopPropagation();
        $("#userDropdown").toggleClass("show");
    });

    $(document).on("click", function () {
        $("#userDropdown").removeClass("show");
    });

});

//  blur before open
$('#moodModal').on('show.bs.modal', function () {
    document.activeElement.blur();

    $.get('/get-moods', function(data){

        // Summary chips
        let moodCounts = {};
        data.forEach(function(item){
            moodCounts[item.mood] = (moodCounts[item.mood] || 0) + 1;
        });
        let summaryHtml = '';
        Object.keys(moodCounts).forEach(function(mood){
            summaryHtml += `<span class="mood-chip">${mood} <b>${moodCounts[mood]}</b></span>`;
        });
        $('#moodSummary').html(summaryHtml);

        // Entries
        if(data.length === 0){
            $('#moodList').html('');
            $('#moodEmpty').show();
        } else {
            $('#moodEmpty').hide();
            const moodLabels = {
                '😞': { label: 'Sad',     color: '#6B8FCC', bg: '#EBF2FF' },
                '😐': { label: 'Neutral',  color: '#8A7EC8', bg: '#F0EDFF' },
                '🙂': { label: 'Good',     color: '#3BAA74', bg: '#E8FAF2' },
                '😄': { label: 'Great',    color: '#E8A020', bg: '#FFF6E3' },
            };
            let html = '';
            data.forEach(function(item){
                let meta = moodLabels[item.mood] || { label: 'Mood', color: '#534AB7', bg: '#EEEDFE' };
                let date = new Date(item.created_at);
                let dateStr = date.toLocaleDateString('en-US', { weekday:'short', month:'short', day:'numeric' });
                let timeStr = date.toLocaleTimeString('en-US', { hour:'2-digit', minute:'2-digit' });
                html += `
                <div class="mood-entry">
                    <div class="mood-entry-emoji" style="background:${meta.bg};">${item.mood}</div>
                    <div class="mood-entry-info">
                        <span class="mood-entry-label" style="color:${meta.color};">${meta.label}</span>
                        <span class="mood-entry-date">${dateStr} · ${timeStr}</span>
                    </div>
                </div>`;
            });
            $('#moodList').html(html);
        }
    });
});

//  focus modal
$('#moodModal').on('shown.bs.modal', function () {
    $('#moodModal').focus();
});

//  reset focus
$('#moodModal').on('hidden.bs.modal', function () {
    $('body').focus();
});

</script>

<script>
function startListening() {
    isVoiceInput = true;

    const btn = document.querySelector('.mic-btn');
    btn.classList.add('listening');

    const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
    recognition.lang = 'en-US';
    recognition.start();

    recognition.onresult = function(event) {
        let text = event.results[0][0].transcript;
        document.getElementById("messages").value = text;
        $("#send").click();
        btn.classList.remove('listening');
    };

    recognition.onerror = function() {
        isVoiceInput = false;
        btn.classList.remove('listening');
        alert("Mic error, try again");
    };
}
</script>

<script>
function speak(text) {
    window.speechSynthesis.cancel();

    let speech = new SpeechSynthesisUtterance(text);
    speech.lang = "en-US";
    speech.rate = 0.9;

    window.speechSynthesis.speak(speech);
}
</script>

<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

@if ($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var myModal = new bootstrap.Modal(document.getElementById('registerModal'));
        myModal.show();
    });
</script>
@endif

</body>
</html>