web kasir sederhana

Web kasir ini adalah aplikasi Point Of Sale (POS) berbasis web.Project ini dibuat sebagai media belajar saya yang ingin menjadi seorang back end developer.Fokus utama project ini adala implementasi autentikasi,CRUD,validasi dan pengelolaan databse.

FITUR 
-Authentication menggunakan Laravel Breeze 
  -Login
  -Register
  -Log out 
  -Forget Password 
  -Reset password
-Dashboard
-CRUD Produk
-CRUD Transaksi
-Validasi Form 
-Mencetak Struk

TEKNOLOGI
-Laravel 13
-Mysql
-PHP 8
-Bootstrap/Tailwind CSS (template)
-JavaScript
-Git
-Github

FITUR KEAMANAN
CSRF Protection (`@csrf`):** Mencegah serangan pemalsuan permintaan antar situs pada seluruh form input.
2. **Role-Based Access Control (RBAC):** Proteksi tingkat rute (*Route Middleware*) untuk membatasi akses halaman sensitif berdasarkan role pengguna (`admin` vs `kasir`).
3. **Prepared Statements / Anti SQL Injection:** Pemanfaatan Eloquent ORM Laravel untuk mengamankan kueri database.
4. **XSS Protection:** Sanitasi otomatis pada Blade Template Engine (`{{ }}`).
5. **Mass Assignment Protection:** Penggunaan properti `$fillable` pada Model untuk mengamankan kolom database dari manipulasi data tak berijin.

Cara menjalankan Project

1. Clone Repository
bash
```
git clone https://github.com/daffa736/web-kasir.git
```
3. Masuk ke Folder
bash
```
cd web-kasir
```

5. Install dependency
bash
```
composer install
```

7. salin file environment 
bash
```
cp .env.example .env
 ```
9. Generate application key
bash
```
php artisan key:generate
```
11. atur konfigurasi pada file .env
12. jalankan migrate
```
php artisan migrate
```

14. jalankan serve

```
php artisan serve
```
APLIKASI INI MASIH DALAM TAHAP PENGEMBANGAN

