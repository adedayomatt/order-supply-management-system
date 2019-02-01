<?php

namespace App\Providers;
use App\User;
use App\Customer;
use App\Order;
use App\Supply;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $Global = array(
            '_users' => User::class,
			'_customers' => Customer::class, 
            '_orders' => Order::class,
            '_supplies' => Supply::class,
            '_unit' => 'Bags'
		);
		View::share($Global);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
