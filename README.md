# 🏫 Web TK Asy-Syifa

Web TK Asy-Syifa adalah aplikasi berbasis web yang dikembangkan untuk membantu proses pengelolaan data dan administrasi di lingkungan TK Asy-Syifa.

Aplikasi ini menyediakan sistem manajemen data berbasis web dengan fitur autentikasi, pengelolaan pengguna, pengaturan hak akses, serta proses pengelolaan dan administrasi data.

## 📸 Preview Application

### Dashboard

<p align="center">
  <img src="screenshots/dashboard.png" alt="Dashboard Web TK Asy-Syifa" width="850">
</p>

Dashboard memberikan tampilan ringkasan dan akses cepat terhadap fitur-fitur utama sistem.

### Login

<p align="center">
  <img src="screenshots/login.png" alt="Login Page" width="850">
</p>

Sistem menyediakan autentikasi pengguna sebelum pengguna dapat mengakses fitur sesuai dengan hak akses yang dimiliki.

### Data Management

<p align="center">
  <img src="screenshots/data-management.png" alt="Data Management" width="850">
</p>

Pengguna dapat melakukan pengelolaan data melalui fitur CRUD yang tersedia pada sistem.

### Import and Export Data

<p align="center">
  <img src="screenshots/import-export.png" alt="Import Export Data" width="850">
</p>

Sistem mendukung proses import dan export data untuk mempermudah pengelolaan dan administrasi informasi.

## ✨ Features

* 🔐 Authentication
* 👤 User management
* 🛡️ Role and permission management
* 📝 CRUD data management
* 📥 Data import
* 📤 Data export
* 🗄️ Database management

## 🛠️ Tech Stack

| Technology | Description               |
| ---------- | ------------------------- |
| PHP        | Programming language      |
| Laravel    | Web framework             |
| MySQL      | Database                  |
| Bootstrap  | Frontend framework        |
| JavaScript | Interactive functionality |

## 📂 Project Structure

```text
web-tk-asy-syifa-2/
│
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── screenshots/
│   ├── dashboard.png
│   ├── login.png
│   ├── data-management.png
│   └── import-export.png
│
├── .env.example
├── composer.json
└── README.md
```

## ⚙️ Installation

Clone repository:

```bash
git clone https://github.com/ghifari-naufal/web-tk-asy-syifa-2.git
```

Masuk ke folder project:

```bash
cd web-tk-asy-syifa-2
```

Install dependency:

```bash
composer install
```

Buat file `.env`:

```bash
copy .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Atur konfigurasi database pada file `.env`, kemudian jalankan migration:

```bash
php artisan migrate
```

Jalankan aplikasi:

```bash
php artisan serve
```

Buka:

```text
http://127.0.0.1:8000
```

## 👨‍💻 Author

**Ghifari Naufal**

* GitHub: https://github.com/ghifari-naufal
