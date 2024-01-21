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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        if (config('database.default') == 'sqlite') {
            $db = config('database.connections.sqlite.database');
            if (!file_exists($db) && is_writable(dirname($db))) {
                file_put_contents($db, null);
                DB::connection()->getSchemaBuilder()->create('migrations', function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('migration');
                    $table->integer('batch');
                });
            }
        }
    }
}
