<?php

namespace App\Providers;
use App\Composers\HomeComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }
    public function boot()
    {
        // View::composer('admin.home', HomeComposer::class);
    }
}
