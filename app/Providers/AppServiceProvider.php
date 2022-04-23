<?php

namespace App\Providers;

use App\Repositories\CommentsRepository;
use App\Repositories\Contracts\CommentsRepositoryInterface;
use App\Services\AwsPublicLinkService;
use App\Services\Contracts\AwsPublicLinkInterface;
use App\Services\Contracts\InvoicesServiceInterface;
use App\Services\InvoicesService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        CommentsRepositoryInterface::class => CommentsRepository::class,
        InvoicesServiceInterface::class => InvoicesService::class,
        AwsPublicLinkInterface::class => AwsPublicLinkService::class,
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
        \Illuminate\Filesystem\AwsS3V3Adapter::macro('getClient', fn() => $this->client);
    }
}
