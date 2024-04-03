<?php

namespace App\Providers;

use App\Classes\Tools;
use Illuminate\Support\ServiceProvider;

class ToolServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind('tools', function() {
            return new Tools;
        });
    }

    public function boot(): void
    {
        //
    }
}
