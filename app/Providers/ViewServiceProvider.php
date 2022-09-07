<?php

namespace App\Providers;

use App\View\Composer\DashboardComposer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Log::debug('message'); //fails, Log facade alias isn't available yet
        $this->app['log']->debug('message');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer("admin.dashboard.layouts.sidebar", DashboardComposer::class);
    }
}
