<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RoomRepository::class, \App\Repositories\RoomRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ActiveRepository::class, \App\Repositories\ActiveRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ChatRepository::class, \App\Repositories\ChatRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RoomRepository::class, \App\Repositories\RoomRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ActiveRepository::class, \App\Repositories\ActiveRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ChatRepository::class, \App\Repositories\ChatRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RoomRepository::class, \App\Repositories\RoomRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ActiveRepository::class, \App\Repositories\ActiveRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ChatRepository::class, \App\Repositories\ChatRepositoryEloquent::class);
        //:end-bindings:
    }
}
