<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Auth;

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
        Blade::if('role', function($role) {
            $check = Auth::check();
            $roles = explode("|", $role);
            foreach($roles as $r) {
                $r = ucfirst($r);
                $check = $check && Auth::user()->role->name == constant("App\Role::{$r}");
            }
           return $check;
        });

        Carbon::setLocale('fr');
        Carbon::setUtf8(true);
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
