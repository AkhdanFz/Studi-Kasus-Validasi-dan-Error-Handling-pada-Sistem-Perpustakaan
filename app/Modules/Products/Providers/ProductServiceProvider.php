<?php

namespace App\Modules\Products\Providers;

use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }
 
    public function boot(): void
    {
        $this->loadRoutesFrom(
            __DIR__ . '/../routes/web.php'
        );
     }
}