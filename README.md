## INFORMASI INSTALL LARAVEL ASSESMENT KLEDO

### Langkah Pertama

Jalankan perintah `composer install`

### Langkah Kedua

Buatlah database dengan nama database `assesment_kledo`

### Langkah Ketiga

Jalankan perintah `cp .env.example .env` lalu ubah file `.env` sesuai dengan konfigurasi database anda

### Langkah Keempat

Jalankan perintah `php artisan key:generate` serta selanjutnya jalankan perintah `php artisan migrate --seed`

## Langkah Kelima

ketik commad `php artisan serve` pada terminal untuk menjalan kan aplikasi

## TEST UNIT

### Menjalankan Test Unit

Untuk menjalankan test unit. silahkan anda ketik pada command line interface `vendor/bin/phpunit`

## Dokumentasi Swagger

Anda dapat melihat endpoint swagger pada link berikut `https://app.swaggerhub.com/apis/febryanpratama/assesment-kledo/1.0#/`. selain itu saya juga membuat collection Postman jika anda ingin melakukan import collection. file tersebut tersedia pada `assesment_kledo/Assesment Kledo.postman_collection.json`
