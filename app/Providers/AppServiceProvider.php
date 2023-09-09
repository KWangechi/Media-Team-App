<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
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
        if (!app()->runningInConsole() || app()->runningUnitTests()) {

            // share announcements with navigation blade file
            view()->share('announcements', DB::table('notifications')->where('read_at', '=', null)->get());
        }
    }
}
