## Panduan Penggunaan

-   Jalankan `composer update` In directory root projct
-   Kemudian jalankan `copy .env.example .env`
-   Selanjutnya jalankan `php artisan key:generate`
-   Buat databas <b>wisata_jepara</b> di phpmyadmin
-   Langkah selanjutnya setting database nya di .env sebagai berikut:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=wisata_jepara
    DB_USERNAME=root
    DB_PASSWORD=
    ```

-   Lanjut jalankan `php artisan migrate`
-   Janalankan `php artisan storage:link`
-   Dan yang terakhir jalankan `php artisan serve`
-   Login System dengan mengguanka account :

    ```env
    LOGIN ADMIN
    email :dev.burhanuddin@gmail.com
    password :Admin123

    LOGIN ANOTEHER USER
    email :arno@gmail.com
    password :Admin123
    ```

-   Well Done
