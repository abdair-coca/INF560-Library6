# 📚 Library App

<p align="center">
  <img src="docs/assets/library-banner.svg" alt="Library App Banner" width="100%" />
</p>

<p align="center">
  <strong>Modern Library Management System</strong><br>
  Built with Laravel 13, PostgreSQL & TailwindCSS
</p>

<p align="center">
  <img alt="Laravel" src="https://img.shields.io/badge/Laravel-13-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />
  <img alt="PHP" src="https://img.shields.io/badge/PHP-8.3+-777BB4?style=for-the-badge&logo=php&logoColor=white" />
  <img alt="PostgreSQL" src="https://img.shields.io/badge/PostgreSQL-14+-4169E1?style=for-the-badge&logo=postgresql&logoColor=white" />
  <img alt="TailwindCSS" src="https://img.shields.io/badge/TailwindCSS-UI-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white" />
  <img alt="License" src="https://img.shields.io/badge/License-MIT-22C55E?style=for-the-badge" />
  <img alt="Version" src="https://img.shields.io/badge/Version-1.0.0-A855F7?style=for-the-badge" />
</p>

<p align="center">
  <a href="#-features">Features</a> •
  <a href="#-preview">Preview</a> •
  <a href="#-tech-stack">Tech Stack</a> •
  <a href="#-installation">Installation</a> •
  <a href="#-project-architecture">Architecture</a> •
  <a href="#-roadmap">Roadmap</a>
</p>

---

# ✨ Overview

**Library App** is a modern and colorful library management system designed for academic and real-world learning purposes.

The project was developed incrementally through backend laboratory guides for the subject:

> **INF560 — Backend Web Development**

It focuses on:

- scalable backend architecture
- clean code practices
- RESTful design
- reusable UI components
- maintainable Laravel structure
- developer-friendly experience

---

# 🎯 Features

<div align="center">

| Feature | Description |
|---|---|
| 📖 Books Management | Complete CRUD for books |
| ✍️ Authors | Many-to-many relationships |
| 🏷️ Categories | Book classification system |
| 👤 Members | User/member administration |
| 🔁 Loans | Loan and availability logic |
| 🔐 Authentication | Login, roles & middleware |
| 🗑️ Soft Deletes | Safe record deletion |
| ✅ Validations | Form Requests & custom rules |
| ⚡ Optimized Queries | Eager loading & clean ORM usage |

</div>

---

# 🖼️ Preview

## 🏠 Dashboard and Books List

<p align="center">
  <img src="docs/screenshots/dashboard.png" alt="Dashboard" width="100%">
</p>

---

## 📖 Book Details

<p align="center">
  <img src="docs/screenshots/book-show.png" alt="Book Details" width="100%">
</p>

---

## ✏️ Book Form

<p align="center">
  <img src="docs/screenshots/book-form.png" alt="Book Form" width="100%">
</p>

---

## 👨‍💼 Authors Management

<p align="center">
  <img src="docs/screenshots/authors-index.png" alt="Authors" width="100%">
</p>

---

## 🏷️ Categories

<p align="center">
  <img src="docs/screenshots/categories-index.png" alt="Categories" width="100%">
</p>

---

## 🔐 Authentication

<p align="center">
  <img src="docs/screenshots/auth-login.png" alt="Login" width="100%">
</p>

---

# 🧠 Academic Context

| Field | Information |
|---|---|
| 📘 Subject | INF560 — Backend Web Development |
| 🏫 University | Universidad Autónoma Tomás Frías (UATF) |
| 📍 Location | Potosí, Bolivia |
| 👨‍🏫 Professor | M. Sc. Huáscar Fedor Gonzales Guzmán |

---

# 🧱 Tech Stack

## ⚙️ Backend

- Laravel 13
- PHP 8.3+
- Eloquent ORM
- Form Requests
- RESTful Controllers
- Middleware & Authentication

---

## 🗄️ Database

- PostgreSQL 14+
- Laravel Migrations
- Seeders & Factories

---

## 🎨 Frontend

- Blade Templates
- TailwindCSS
- Reusable Components
- Responsive Design

---

# 🎨 Design System

The project follows a visual identity inspired by:

- 🎨 Neo-brutalist UI
- ✨ Friendly UX
- 🌈 Vibrant colors
- 🧩 Rounded components
- 📦 Strong shadows & borders

### Typography

- Fredoka One
- Nunito

### Brand Palette

| Color | Usage |
|---|---|
| 🟡 Yellow | Highlights |
| 🟠 Orange | Actions |
| 🌸 Pink | Accent |
| 🔵 Blue | Primary |
| 🟣 Purple | Branding |
| 🟢 Green | Success |

---

# ⚡ Installation

## 📋 Requirements

- PHP 8.3+
- Composer
- PostgreSQL 14+
- Node.js 18+
- Git

---

## 🚀 Quick Setup

### 1️⃣ Clone Repository

```bash
git clone https://github.com/HuascarFedor/INF560_libraryApp.git
cd INF560_libraryApp
```

---

### 2️⃣ Environment Variables

```bash
cp .env.example .env
```

---

### 3️⃣ Install Dependencies

```bash
composer install
```

---

### 4️⃣ Generate Application Key

```bash
php artisan key:generate
```

---

### 5️⃣ Configure PostgreSQL

Create database:

```sql
CREATE DATABASE library_db;
```

Example `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=library_db
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

---

### 6️⃣ Run Migrations & Seeders

```bash
php artisan migrate --seed
```

---

### 7️⃣ Frontend Assets

```bash
npm install
npm run dev
```

---

### 8️⃣ Start Development Server

```bash
php artisan serve
```

Application available at:

```txt
http://localhost:8000
```

---

# 🧭 Useful Commands

## 📌 Routes

```bash
php artisan route:list
```

---

## 🗄️ Database

```bash
php artisan migrate
php artisan migrate:refresh --seed
```

---

## ⚡ Cache

```bash
php artisan cache:clear
php artisan config:clear
```

---

## 🏗️ Generators

```bash
php artisan make:model Book -m
php artisan make:controller BookController --resource
php artisan make:seeder BookSeeder
```

---

## 🧪 REPL

```bash
php artisan tinker
```

---

# 🧩 Project Architecture

```txt
app/
├── Http/
│   ├── Controllers/
│   ├── Requests/
│   └── Middleware/
│
├── Models/
│
resources/
├── views/
│   ├── books/
│   ├── authors/
│   ├── categories/
│   └── components/
│
database/
├── migrations/
├── seeders/
└── factories/
```

---

# 📚 Academic Roadmap

| Guide | Version | Main Focus |
|---|---|---|
| Guide 4 | v0.1.0 | Laravel setup + PostgreSQL |
| Guide 5 | v0.2.0 | Models & Eloquent relationships |
| Guide 6 | v0.3.0 | REST Controllers & Blade |
| Guide 7 | v0.4.0 | Full CRUD + Soft Delete |
| Guide 8 | v0.5.0 | Advanced validation |
| Guide 9 | v0.6.0 | Authentication & Roles |

---

# ✅ Best Practices Applied

- RESTful conventions
- Clean architecture
- Separation of responsibilities
- Reusable Blade components
- Eager loading optimization
- Form Request validation
- Flash messages & error handling
- Semantic commit structure
- Git versioning with tags

---

# 🧪 Testing

Run Laravel tests:

```bash
php artisan test
```

Or directly with PHPUnit:

```bash
vendor/bin/phpunit
```

---

# 📂 Suggested README Assets Structure

```txt
docs/
├── assets/
│   └── library-banner.png
│
└── screenshots/
    ├── dashboard.png
    ├── books-index.png
    ├── book-show.png
    ├── book-form.png
    ├── authors-index.png
    ├── categories-index.png
    └── auth-login.png
```

---

# 🤝 Contributing

Contributions are welcome.

## Workflow

```bash
# Fork repository

# Create feature branch
git checkout -b feature/my-feature

# Commit changes
git commit -m "feat: add new feature"

# Push branch
git push origin feature/my-feature
```

Then open a Pull Request 🚀

---

# 📄 License

This project is licensed under the MIT License.

If the project is used only for academic purposes, you can modify this section accordingly.

---

# 👨‍💻 Author

Developed for the subject:

> **INF560 — Backend Web Development**

Focused on:
- backend best practices
- scalable Laravel architecture
- modern UI experience
- educational software engineering

---

<p align="center">
  <strong>Built with Laravel ❤️ + colorful design 📚✨</strong>
</p>
