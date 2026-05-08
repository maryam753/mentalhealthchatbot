# Mental Health Chatbot (Final Year Project)

A Laravel-based AI-powered Mental Health Chatbot that helps users express emotions, receive supportive responses, and improve mental well-being through an interactive chat system.

---

##  Project Overview

This Final Year Project (FYP) provides a safe and supportive platform where users can communicate with an AI chatbot. The system allows users to share their feelings, receive emotional guidance, and interact through text or voice-based communication.

The main goal of this project is to promote mental health awareness and provide a simple digital support system using AI.

---

##  Features

-  User Registration & Login System  
-  GitHub Social Login (Laravel Socialite)  
-  Google Authentication (OAuth Login)  
-  AI-Powered Chatbot Integration  
-  Real-time Chat System  
-  Mental Health Support Responses  
-  Voice Input (Speech-to-Text)  
-  Voice Output (Text-to-Speech)  
-  Clean & Responsive UI  

---

##  Tech Stack

- Laravel (PHP Framework)  
- Blade Templates (Frontend)  
- MySQL Database  
- GitHub OAuth (Socialite)  
- Google OAuth  
- AI API (Gemini / Custom AI Service)  
- Web Speech API (Voice Features)  
- HTML, CSS, JavaScript  

---

##  Installation Guide

Follow these steps to run the project locally:

```bash
git clone https://github.com/maryam753/mentalhealthchatbot.git
cd mentalhealthchatbot
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
