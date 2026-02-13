# Leave Management System

A Laravel 12-based leave management application for managing employee leave requests with role-based access control (Admin and Employee roles).

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Running the Application](#running-the-application)
- [Database Setup](#database-setup)
- [Features](#features)


## Requirements

- **PHP**: 8.2 or higher
- **Composer**: Latest version
- **Node.js**: 18+ (for npm)
- **Database**: MySQL
- **Web Server**: Apache or Nginx (Laragon includes this)

## Installation

### 1. Navigate to Project Directory

```bash
cd c:\laragon\www\leave-managements
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Quick Setup (All-in-One)

Run the complete setup with a single command:

```bash
composer setup
```

This command will:
- Install Composer dependencies
- Create `.env` file from `.env.example`
- Generate application key
- Run database migrations
- Install Node dependencies
- Build frontend assets

## Configuration

### Environment Variables

Create a `.env` file in the root directory. Key variables:

```env
APP_NAME="Leave Management System"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

# Database Configuration 

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=leave_management
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations:
```bash
php artisan migrate:fresh --seed
```

## Running the Application

### Manual Server Start

**Terminal - PHP Development Server:**
```bash
php artisan serve
```

Access the application at: **http://127.0.0.1:8000**


## Database Setup

### Running Migrations

Create all necessary database tables:

```bash
php artisan migrate
```

### Seeding the Database

Populate with sample users (Admin and Employees):

```bash
php artisan db:seed --class=UserSeeder
```



### Sample Test Users

| Name | Email | Password | Role |
|------|-------|----------|------|
| Admin User | admin@example.com | Admin123 | Admin |
| Budi | employee@example.com | Budi123 | Employee |
| Ayu | another@example.com | Ayu123 | Employee |

## Features

### Current Features

- ✅ User authentication (Login/Logout)
- ✅ Role-based access control (Admin & Employee)
- ✅ Leave request management
- ✅ Employee information management
- ✅ Responsive design with Tailwind CSS
- ✅ Real-time asset compilation with Vite
- ✅ Database seeding for test data

### User Roles & Permissions

**Admin:**
- View all leave requests
- Approve/Reject leave requests
- Manage employee records
- System administration

**Employee:**
- Submit leave requests
- View own leave history
- Track leave balance
- Manage personal information


## License

MIT License - This project is open source.
