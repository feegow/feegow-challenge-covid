# Feegow App (feegow-challenge-covid-backend)

Challenge Covid

## Instruções Para Backend

cd feegow-challenge-covid-backend

``` bash
composer install
```

## Levantar Dockers

``` bash
vendor/bin/sail up -d
```

## Executar as migrations

``` bash
docker exec -it feegow-challenge-covid-backend-laravel.test-1 php artisan migrate
```

## Executar os seeders para primeiros dados do banco de dados

``` bash
php artisan db:seed
```

## Executar dump-autoload

``` bash
composer dump-autoload 
```
