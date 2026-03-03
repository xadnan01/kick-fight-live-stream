# 🐓 Kick Fight Live Stream API (Laravel 12)

A modern, scalable, API-driven backend built using **Laravel 12** for managing Kokar (Rooster) Fight live streaming, authentication, and administration panel.

This project uses:
- **Laravel Sanctum** for token-based authentication  
- **Form Request Validation**  
- **Clean Architecture Services**  
- **Reusable API Response Service**  
- **Admin-based Authentication System**  
- **Password Reset (Token-based)**  

---

## 🚀 Features

### 🔐 **Admin Authentication (Sanctum Token)**
- Admin Register
- Admin Login
- Admin Logout
- Forgot Password (Token Generated)
- Reset Password (Token Verified)
- Form Request based validation
- Secure & optimized JSON API responses

### 🐓 **Kokar Fight Module** *(Coming Soon)*
- Fight creation
- Fight listing
- Live stream scheduling
- Fight details API

### 🔧 **Reusable Helpers**
- Global `ApiResponseService` for success/error responses
- Centralized validation files
- Token management

```
## 📁 Project Structure (Important Files)

app/
├─ Http/
│ ├─ Controllers/Api/AdminAuthController.php
│ ├─ Requests/
│ │ ├─ AdminLoginRequest.php
│ │ ├─ AdminRegisterRequest.php
│ │ ├─ AdminForgotPasswordRequest.php
│ │ └─ AdminResetPasswordRequest.php
├─ Models/Admin.php
├─ Services/ApiResponseService.php
database/
├─ migrations/
└─ seeders/AdminSeeder.php
routes/
├─ api.php

```

## 🔑 Authentication Flow (Sanctum)

### Login  
Returns token:

```json
{
  "success": true,
  "message": "Login successful",
  "data": {
    "admin": {
      "id": 1,
      "name": "Super Admin",
      "email": "admin@test.com"
    },
    "token": "xxxxx"
  }
}

Authorization: Bearer YOUR_TOKEN_HERE

🛠 Installation

1. Clone Repository
    git clone https://github.com/xadnan01/kick-fight-live-stream.git
cd kick-fight-live-stream

2. Install Dependencies
    composer install
3. Copy Environment File

    cp .env.example .env

4. Generate App Key
    php artisan key:generate

5. Configure Database in .env

6. Run Migrations
    php artisan migrate

7. Seed Admin User
    php artisan db:seed --class=AdminSeeder

🔗 API Routes (Authenticated & Public)

Public Admin Routes
    POST /api/admin/register
    POST /api/admin/login
    POST /api/admin/forgot-password
    POST /api/admin/reset-password
    Protected Admin Routes    
    POST /api/admin/logout   (requires Bearer token)

🧪 Testing API with Postman
Forgot Password
{
  "email": "admin@test.com"
}
Reset Password
{
  "email": "admin@test.com",
  "token": "RESET_TOKEN_HERE",
  "password": "newpassword",
  "password_confirmation": "newpassword"
}
🧰 Technologies Used

Laravel 12

Laravel Sanctum

PHP 8.2+

MySQL / MariaDB

Composer

Postman (API testing)

Git & GitHub

👨‍💻 Author

Muhammad Adnan Baig (xadnan01)
Laravel Developer
Working on advanced API architectures and real-time systems.

📄 License

This project is open-source and licensed under the MIT License.


---

# 🎉 Your README.md is now ready!
