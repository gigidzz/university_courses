<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Faculty;
use App\Repositories\CachedFacultyRepository;
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
        $this->app->bind(FacultyRepositoryInterface::class, static function ($app) {
            return new CachedFacultyRepository(
                new FacultyRepository(new Faculty()),
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
