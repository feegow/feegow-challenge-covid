For development

./vendor/bin/sail up -d

./vendor/bin/sail npm run dev

For production

./vendor/bin/sail up -d

./vendor/bin/sail artisan migrate

./vendor/bin/sail npm run build

./vendor/bin/sail artisan db:seed

./vendor/bin/sail artisan optimize

./vendor/bin/sail artisan route:cache
./vendor/bin/sail artisan config:cache

./vendor/bin/sail artisan queue:work
