<?php

namespace App\Providers;

use Covid\Domain\Employee\Persistence\EmployeeRepository;
use Covid\Infrastructure\Persistence\EmployeeRespositoryEloquent;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            EmployeeRepository::class,
            EmployeeRespositoryEloquent::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
