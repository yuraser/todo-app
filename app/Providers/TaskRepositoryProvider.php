<?php

namespace App\Providers;

use App\Repositories\Task\AbstractTaskRepository;
use App\Repositories\Task\TaskRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class TaskRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AbstractTaskRepository::class, function(Application $app){
            return new TaskRepository();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
