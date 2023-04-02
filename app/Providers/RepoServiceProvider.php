<?php

namespace App\Providers;


use App\Repository\StudentsRepository;
use App\Repository\TeachersRepository;
use App\Repository\promotionRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\StudentsRepositoryInterface;
use App\Repository\TeachersRepositoryInterface;
use App\Repository\promotionRepositoryInterface;


class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    

            $this->app->bind(TeachersRepositoryInterface::class,TeachersRepository::class);
            $this->app->bind(StudentsRepositoryInterface::class,StudentsRepository::class);
            $this->app->bind(promotionRepositoryInterface::class,promotionRepository::class);


        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
