## Requirements

- PHP 8.1 atau lebih tinggi
- Web Server seperti Apache (bisa menggunakan XAMPP atau Laragon)
- MySQL Database

## Cara Instalasi di Lokal

1. Clone repository

git clone git@github.com:meimuktiwardana/task-manager.git

2. Masuk ke folder project

3. Install dependency menggunakan Composer

composer install

4. Salin file .env

    Ubah nama file .env.example menjadi .env

5. Buat database

    Buat database baru di MySQL, dengan nama task_manager.

    Import file task_manager.sql ke dalam database tersebut.

6. Jalankan server lokal

php artisan serve

7. Akses aplikasi

    Buka browser dan akses http://127.0.0.1:8000 atau http://localhost:8000.

8. Login Admin

    Email: admin@admin.com

    Password: admin1234


## Dokumentasi

Untuk panduan penggunaan fitur dan dokumentasi lengkap, silakan lihat pada folder dokumen.
