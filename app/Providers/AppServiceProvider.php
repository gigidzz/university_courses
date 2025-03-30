<?php

namespace App\Providers;

use App\Repositories\FacultyRepository;
use App\Repositories\FacultyRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(FacultyRepositoryInterface::class, FacultyRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
