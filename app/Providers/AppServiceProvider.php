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

        // Otomatis buat atau update password admin setiap kali aplikasi boot
        // Ini memastikan admin selalu ada di database Railway
        try {
            if (Schema::hasTable('users')) {
                User::updateOrCreate(
                    ['email' => 'admin@cake.com'],
                    [
                        'name'     => 'Admin Ayasha',
                        'password' => Hash::make('admin123'),
                        'role'     => 'admin',
                    ]
                );
            }
        } catch (\Exception $e) {
            // Abaikan jika database belum siap
        }
    }
}
