<?php

namespace App\Providers;

use App\Interfaces\AuthenticationInterface;
use App\Interfaces\ProductInterface;
use App\Repositories\AuthenticationRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthenticationInterface::class, AuthenticationRepository::class);
        $this->app->bind(ProductInterface::class, ProductRepository::class);
    }
}
