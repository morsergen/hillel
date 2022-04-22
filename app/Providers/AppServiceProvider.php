<?php

namespace App\Providers;

use App\Repositories\CommentsRepository;
use App\Repositories\Contracts\CommentsRepositoryInterface;
use App\Services\Contracts\InvoicesServiceInterface;
use App\Services\InvoicesService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        CommentsRepositoryInterface::class => CommentsRepository::class,
        InvoicesServiceInterface::class => InvoicesService::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
