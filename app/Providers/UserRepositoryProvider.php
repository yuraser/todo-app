<?php

namespace App\Providers;

use App\Repositories\User\UserRepository;
use App\Repositories\User\AbstractUserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class UserRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        app()->bind(AbstractUserRepository::class, function(Application $app){
            return new UserRepository();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }
}
