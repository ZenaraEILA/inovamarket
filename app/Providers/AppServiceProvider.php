<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Share cart data globally
        View::composer('*', function ($view) {
            if (auth()->check() && auth()->user()->isUser()) {
                $cartCount = session('cart', []);
                $cartTotal = array_sum(array_map(function ($item) {
                    return $item['quantity'];
                }, $cartCount));

                $view->with('cartCount', $cartTotal);
            }
        });
    }
}
