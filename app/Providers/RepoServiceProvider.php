<?php

namespace App\Providers;


use App\Repository\TeachersRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\TeachersRepositoryInterface;


class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    

            $this->app->bind(TeachersRepositoryInterface::class,TeachersRepository::class);
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
