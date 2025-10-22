# Aplikasi Video Streaming Laravel

Aplikasi ini adalah sistem video streaming dengan manajemen video dan akses pengguna (admin & customer).

## Persyaratan

-   PHP >= 8.1
-   Composer
-   MySQL / MariaDB
-   Node.js & NPM (opsional, jika menggunakan frontend assets)
-   Laravel 10

## Instalasi

1. **Clone repository**

```bash
git clone <repository-url>
cd <nama-folder>
```

2. **Install dependencies**

```bash
composer install
```

3. **Salin file environment**

```bash
cp .env.example .env
```

4. **Atur konfigurasi database**  
   Edit `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

5. **Generate application key**

```bash
php artisan key:generate
```

6. **Jalankan migrasi dan seeding (opsional)**

```bash
php artisan migrate
php artisan db:seed
```

7. **Jalankan server Laravel**

```bash
php artisan serve
```

-   Server akan berjalan di: [http://127.0.0.1:8000](http://127.0.0.1:8000)

## User & Admin

-   Admin bisa mengelola video dan permintaan akses.
-   Customer bisa menonton video sesuai izin dan mengajukan permintaan perpanjangan waktu.

## Folder Penting

-   `app/Models` → Model database
-   `app/Http/Controllers/Admin` → Controller admin
-   `app/Http/Controllers/Customer` → Controller customer
-   `resources/views` → Blade template
-   `public/videos` → Tempat menyimpan video yang di-upload

## Notes

-   Pastikan folder `public/videos` writable agar video bisa di-upload.
-   Video YouTube bisa ditampilkan via iframe, video lokal harus berada di `public/videos`.
-   Request akses video dilakukan oleh customer, disetujui oleh admin.
