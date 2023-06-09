<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        // custom currency Rp
        Blade::directive('rupiah', function ($expression) {
            return "Rp <?php echo number_format($expression,2,',','.'); ?>";
        });

        Gate::define('admin', function (User $user) {
            return $user->role === "ADMIN";
        });

        Gate::define('resepsionis', function (User $user) {
            return $user->role === "RESEPSIONIS";
        });

        Paginator::useBootstrap();
    }
}
