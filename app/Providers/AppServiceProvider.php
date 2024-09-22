<?php

namespace App\Providers;

use App\Listeners\ReportRequestListener;
use Covid\Domain\Employee\Persistence\EmployeeRepository;
use Covid\Domain\Employee\Persistence\MedicineRepository;
use Covid\Infrastructure\Persistence\EmployeeRespositoryEloquent;
use Covid\Infrastructure\Persistence\MedicineRepositoryEloquent;
use Illuminate\Support\Facades\Event;
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

        $this->app->bind(
            MedicineRepository::class,
            MedicineRepositoryEloquent::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::subscribe(ReportRequestListener::class);
    }
}
