<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Modules\Shared\Contracts\ProductServiceInterface; // Perbaikan: Tambahkan App\
use App\Modules\Products\Services\ProductService;           // Perbaikan: Tambahkan App\

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            ProductServiceInterface::class,
            ProductService::class
        );
    }

    public function boot(): void
    {
        // 1. Daftar View Namespace untuk modul Library
        View::addNamespace('Library', base_path('app/Modules/Library/Views'));

        // 2. Otomatis membaca file migrasi di seluruh folder modul (Users, Orders, Products, dll.)
        $this->loadMigrationsFrom(base_path('app/Modules/*/Migrations'));
    }
}