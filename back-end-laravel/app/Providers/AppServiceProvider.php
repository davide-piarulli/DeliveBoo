<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Braintree\Gateway;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        $this->app->singleton(Gateway::class, function () {
          return new Gateway(
            [

              'environment' => ('sandbox'),
              'merchantId' => ('w9r3szjrkky8sc96'),
              'publicKey' => ('7nkb3y55fnqmbs7n'),
              'privateKey' => ('9797621e5d39936d4dfd307d7749065a'),

            ]
          );
      });

    }
}
