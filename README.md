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
2. Masuk ke Folder
bash
cd web-kasir

3. Install dependency
bash 
composer install

4. salin file environment 
bash 
cp .env.example .env
 
5. Generate application key
bash
php artisan key:generate

6. atur konfigurasi pada file .env
7. jalankan migrate
bash 
php artisan migrate

8. jalankan serve
bash
php artisan serve

