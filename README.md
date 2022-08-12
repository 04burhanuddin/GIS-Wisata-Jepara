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
-   Login System dengan mengguanka account

    ```env
    LOGIN ADMIN
    username :04burhanuddin
    password :141004

    LOGIN USER
    username :userBurhan
    password :141004
    ```

-   Well Done
