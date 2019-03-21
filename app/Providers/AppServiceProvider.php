<?php

namespace App\Providers;
use App\User;
use App\Customer;
use App\Payment;
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
            '_user' => User::class,
			'_customer' => Customer::class, 
            '_supply' => Supply::class,
            '_payment' => Payment::class,
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
