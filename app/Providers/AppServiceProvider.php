<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        // Admin-editable site settings (name/contact/social links) override
        // the config/global.php defaults. Wrapped defensively since this
        // runs on every request, including console commands that run
        // before the settings table exists (e.g. the migration itself).
        try {
            if (Schema::hasTable('settings')) {
                $overrides = Setting::allCached();
                if (!empty($overrides)) {
                    config(['global' => array_merge(config('global'), $overrides)]);
                }
            }
        } catch (\Throwable $e) {
            // Fall back to config/global.php defaults.
        }
    }
}
