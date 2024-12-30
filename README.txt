# UAS-SMT3

## Deskripsi Proyek

Proyek ini adalah Pengembangan Aplikasi Web Front & Backend enterprise-level application atau Business Process Automation (BPA). Proyek ini dibuat sebagai bagian dari tugas akhir semester 3. Proyek ini dibangun menggunakan kombinasi bahasa pemrograman PHP, HTML, CSS, dan JavaScript.

## Persyaratan

Sebelum menjalankan proyek ini, pastikan bahwa Anda telah menginstal perangkat lunak berikut:

- PHP (versi 7.4 atau lebih baru)
- Web server (seperti Apache atau Nginx)
- MySQL atau MariaDB
- Composer (untuk mengelola dependensi PHP)

## Instalasi

Ikuti langkah-langkah berikut untuk menginstal dan menjalankan proyek ini di mesin lokal Anda:

1. Clone repositori ini ke direktori lokal Anda:
    ```bash
    git clone https://github.com/diarboy/UAS-SMT3.git
    ```
2. Masuk ke direktori proyek:
    ```bash
    cd UAS-SMT3
    ```
3. Install dependensi menggunakan Composer:
    ```bash
    composer install
    ```
4. Buat database baru di MySQL atau MariaDB dan impor file database (jika ada):
    ```sql
    CREATE DATABASE nama_database;
    USE nama_database;
    SOURCE path/to/database.sql;
    ```
5. Konfigurasi file `.env` atau `config.php` dengan informasi database Anda:
    ```env
    DB_HOST=localhost
    DB_DATABASE=nama_database
    DB_USERNAME=root
    DB_PASSWORD=[kosongkan]
    ```
6. Jalankan server lokal menggunakan PHP:
    ```bash
    php -S localhost:3306
    ```
7. Buka browser dan akses proyek di `http://localhost:3306`.

## Penggunaan

userpass terdapat di db contact_form
admin dan user
