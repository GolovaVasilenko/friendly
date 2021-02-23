<?php

namespace App\Providers;

use App\Http\ViewComposers\AdminMainComposer;
use Illuminate\Support\ServiceProvider;

class ComposerAdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.admin', AdminMainComposer::class);
    }
}
