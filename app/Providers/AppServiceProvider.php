<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
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
        // @role('admin') — abre el bloque
        Blade::directive('role', function (string $role) {
            return "<?php if(Auth::check() && Auth::user()->hasRole({$role})): ?>";
        });

        // @endrole — cierra el bloque
        Blade::directive('endrole', function () {
            return "<?php endif; ?>";
        });
    }
}
