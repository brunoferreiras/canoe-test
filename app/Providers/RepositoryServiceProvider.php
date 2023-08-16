<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(\App\Repositories\FundRepository::class, \App\Repositories\Eloquent\FundRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\FundManagerRepository::class, \App\Repositories\Eloquent\FundManagerRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CompanyRepository::class, \App\Repositories\Eloquent\CompanyRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\FundAliasRepository::class, \App\Repositories\Eloquent\FundAliasRepositoryEloquent::class);
        //:end-bindings:
    }
}
