<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Cart;
class ViewComposerServiceProvider extends ServiceProvider
{

    public function boot()
    {
        View::composer('frontend.layouts.header', function ($view) {
            $view->with('cartCount', Cart::getContent()->count());
        });
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // TODO: Implement register() method.
    }
}