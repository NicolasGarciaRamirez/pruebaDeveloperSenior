<?php

namespace App\Providers;

use App\Observers\TransactionObserver;
use Illuminate\Support\ServiceProvider;
use App\Models\Transactions\Transaction;

class AppServiceProvider extends ServiceProvider
{
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
		Transaction::observe(TransactionObserver::class);
    }
}
