This is basic E-commerce web app built using laravel framework with add to cart and checkout option with COD and admin section to add category and products. 
 

```
composer install
```

```
cp .env.example .env
```

update mysql credentials in .env file

```
php artisan key:generate
```

```
php artisan migrate
```

For admin user
email: admin@gmail.com
pass: testuser@1234
```
php artisan db:seed --class=AddAdminCredentials
```

To add fake products
```
php artisan db:seed --class=ProductsSeeder
```

```
php artisan serve
```
