<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

##About Task


create postgresql DB "test"; <br>
create user "test" password "test" and set all granted for DB "test" or set custom configure for db<br>
in root directory run command "composer install"<br>
in root directory run command "php artisan migrate" <br>
in root directory run command "php artisan passport:install"
configure web server for this manual https://laravel.com/docs/5.5#web-server-configuration for domain "test.local" or you need custom configuration app

if all good you can try http://test.local

register in app

then go to clients menu path

create new client

create new token (token need for access to api)

now you can create, change or delete products

all product was load on "/" page

api:

for export all product you can use "api/clients" path method "GET"

for export one product you can use "/api/client/{id}" for example "http://test.local/api/client/1" path method "GET"

for import products you can use "/api/clients" for example "http://test.local/api/clients" path method "POST"

for authorised in api you need set http headers "Accept:application/json" and "Authorization:Bearer {key}" where key is client token

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
