vendor/bin/sair up -d

docker exec -it feegow-challenge-covid-backend-laravel.test-1 php artisan migrate
php artisan db:seed
composer dump-autoload 