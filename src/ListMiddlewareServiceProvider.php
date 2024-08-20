<?php
namespace levizoesch\listmiddleware;

use Illuminate\Support\ServiceProvider;
use levizoesch\listmiddleware\ListMiddleware;

class ListMiddlewareServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->commands([
            ListMiddleware::class
        ]);
    }
}
