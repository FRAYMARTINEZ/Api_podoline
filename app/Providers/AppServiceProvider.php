<?php

namespace App\Providers;

use App\Repositories\Contracts\PatientRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\PatientRepository;
use App\Repositories\UserRepository;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
