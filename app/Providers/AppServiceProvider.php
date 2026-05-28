<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

        // Otomatis buat admin jika belum ada (Khusus untuk hosting)
        try {
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
