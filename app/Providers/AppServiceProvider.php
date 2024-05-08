<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        //
        Blade::directive('hasPrivilige', function ($privilige) {
            return "<?php if(auth()->check() && auth()->user()->hasPrivilige($privilige)): ?>";
        });

        Blade::directive('endHasPrivilige', function () {
            return "<?php endif; ?>";
        });
    }
}
