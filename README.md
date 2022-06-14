# P79 Test Framework Laravel
## instalasi

Note: Server pembuatan menggunakan laragon & mysql.

1. Clone project dan copy `env.example` menjadi `.env` (sesuaikan nama db jika perlu) .
2. install composer pada commandline file project jika tidak bisa melakukan step 3 `composer install`
3. lalu run `php artisan key:generate`
4. nyalakan server lalu run terminal pada folderproject `php artisan serve` 
5. lalu buat database mysql dengan nama  `p79`
6. kemudian run `php artisan migrate:fresh --seed`
7. jalankan browser local `localhost:8000` 
8. selesai.


## akses login 

Username: superadmin

password: password