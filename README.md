## About Transaction Laravel 7

Laravel 7 Starter App & admin LTE 3

## Installasi
- Download repository dan ekstrak atau clone repository
	```sh
	$ git clone https://github.com/denisuryadi26/transaction.git
	```
- Masuk ke direktori aplikasi dan jalankan composer
	```sh
	$ cd transaction
	$ composer update
	```
 - Copy file .env.example menjadi .env
	```sh
	$ cp .env.example .env
	```
- Generate key application
	```sh
	$ php artisan key:generate
	```
- Buat Database
- Edit database name, database username dan database password di file .env
    ```sh
	DB_DATABASE=db_transaction.
    DB_USERNAME=root.
    DB_PASSWORD=.
	```
- Migrate table
	```sh
	$ php artisan migrate
	```
- Seed table
	```sh
	$ php artisan db:seed
	```
- Jalankan lokal development server
    ```sh
	$ php artisan serve
	```
- Buka di browser http://localhost:8000
- Login
    ```sh
	Username :  admin@admin.com
    Password :  password
	```
