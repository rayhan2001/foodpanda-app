# 🍔 Foodpanda App (SSO Client)
This is the secondary system in a multi-system login setup. It relies on `ecommerce-app` for authenticating users via a secure SSO mechanism.

## 📦 Tech Stack

- Laravel 12
- Laravel Breeze (Blade)
- Bootstrap 5
- Crypt-based token verification
- Laravel Auth (session-based)

## 🚀 Features

- Accept SSO token from `ecommerce-app`
- Automatically log in users
- Secure logout from both systems

## 🔧 Installation

```bash
git clone https://github.com/rayhan2001/foodpanda-app.git
cd foodpanda-app
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install && npm run dev

🔐 SSO Login Flow

Receives encrypted token from ecommerce-app
Decrypts and validates token
Finds user by email and logs them in
Redirects to /dashboard

🔓 Logout Flow

Accessible via /sso-logout
Logs the user out and redirects to /login

✅ Requirements

PHP 8.2+
Laravel 12
Node.js & NPM
MySQL

🔐 Important
Use the same APP_KEY from ecommerce-app in this .env file to ensure token encryption/decryption works correctly.
