<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        if (env('ASSET_URL')) {
            URL::forceRootUrl(env('ASSET_URL'));
        }

        // Otomatis jalankan migrasi dan buat admin (Khusus untuk hosting)
        try {
            // Jalankan migrasi jika tabel users belum ada
            if (!Schema::hasTable('users')) {
                Artisan::call('migrate', ['--force' => true]);
            }

            if (User::where('role', 'admin')->count() === 0) {
                User::create([
                    'name'     => 'Admin Ayasha',
                    'email'    => 'admin@cake.com',
                    'password' => Hash::make('admin123'),
                    'role'     => 'admin',
                ]);
            }
        } catch (\Exception $e) {
            // Abaikan jika database belum siap
        }
    }
}
