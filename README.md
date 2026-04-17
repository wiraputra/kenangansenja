# ☕ Kenangan Senja - Premium Coffee Experience

![Banner](https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&q=80&w=2070)

Kenangan Senja is a full-featured Laravel application designed for a premium coffee shop experience. It features a modern landing page, an integrated ordering system, and a robust admin dashboard for managing products, categories, and sales.

## ✨ Features

- **Premium Landing Page**: A contemporary, responsive hero section with a parallax effect and modern typography.
- **Product Catalog**: Visual menu with detailed descriptions and pricing.
- **User Authentication**: Secure login and registration for customers and administrators.
- **Admin Dashboard**: Comprehensive management of:
  - Products & Categories
  - Promotions & Discounts
  - Orders & Sales Tracking
  - User Management
- **Integrated Payments**: Support for payment tracking and order statuses.
- **Clean Architecture**: Built with Laravel 11 following standard best practices.

## 🚀 Tech Stack

- **Backend**: [Laravel 11](https://laravel.com/) (PHP 8.2+)
- **Frontend**: Blade Templates, Vanilla JavaScript, CSS3
- **Database**: SQLite (Local development)
- **Icons**: [Feather Icons](https://feathericons.com/)
- **Typography**: [Google Fonts](https://fonts.google.com/) (Syne & Inter)

## 🛠️ Installation & Setup

Follow these steps to get the project running locally:

### 1. Prerequisites
Ensure you have the following installed:
- PHP 8.2+
- Composer
- Node.js & NPM

### 2. Clone and Install
```bash
git clone <repository-url>
cd kenangansenja
composer install --ignore-platform-reqs
npm install
```

### 3. Environment Setup
```bash
copy .env.example .env
php artisan key:generate
```

### 4. Database Setup
The project uses SQLite by default. Ensure your `.env` has `DB_CONNECTION=sqlite`.
```bash
# Create the sqlite file
New-Item database/database.sqlite -ItemType File

# Run migrations and seed the admin user
php artisan migrate --seed
```

### 5. Run the Application
Start the backend and frontend dev servers:
```bash
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

## 🔐 Default Credentials

Use these credentials to access the admin dashboard after seeding:
- **Email**: `lin@gmail.com`
- **Password**: `123`

---

Created with ❤️ by **PBL Last Hope** | © 2024 Kenangan Senja
