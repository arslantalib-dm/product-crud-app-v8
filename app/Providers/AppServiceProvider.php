<?php

namespace App\Providers;

use App\Interface\ProductRepositoryInterface;
use App\Repository\ProductRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($data, $message = 'success', $status = 200) {
            return Response::json([
              'errors'  => false,
              'message' => $message ?? 'success',
              'data' => $data,
            ], $status);
        });

        Response::macro('error', function ($message, $status = 400) {
            return Response::json([
              'errors'  => true,
              'message' => $message,
            ], $status);
        });
    }
}
