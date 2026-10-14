<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Runtime environment normalization for Railway deployment
        $defaultConn = config('database.default', env('DB_CONNECTION', 'sqlite'));

        // If not using MySQL, ensure SQLite and session safety
        if ($defaultConn === 'sqlite') {
            $sqlitePath = database_path('database.sqlite');
            config([
                'database.connections.sqlite.database' => $sqlitePath,
                'database.connections.sqlite.url' => null,
            ]);

            // Switch to cookie session to prevent SQLite write-locking on every request
            if (config('session.driver') === 'database' || env('SESSION_DRIVER') === 'database') {
                config(['session.driver' => 'cookie']);
            }
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Ensure SQLite database file and directory exist with write permissions
        if (config('database.default') === 'sqlite') {
            $sqlitePath = config('database.connections.sqlite.database', database_path('database.sqlite'));
            $sqliteDir = dirname($sqlitePath);

            if (!is_dir($sqliteDir)) {
                @mkdir($sqliteDir, 0777, true);
            }

            if (!file_exists($sqlitePath)) {
                @touch($sqlitePath);
            }

            @chmod($sqliteDir, 0777);
            @chmod($sqlitePath, 0666);
        }
    }
}
