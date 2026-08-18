<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * All settings as a flat [key => value] array, cached.
     */
    public static function allCached(): array
    {
        return Cache::rememberForever('settings.all', function () {
            return static::query()->pluck('value', 'key')->toArray();
        });
    }

    public static function get(string $key, ?string $default = null): ?string
    {
        return static::allCached()[$key] ?? $default;
    }

    public static function set(string $key, ?string $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget('settings.all');
    }

    /**
     * Merge saved settings into config('global.*'). Called once per
     * request from AppServiceProvider::boot(); also callable directly
     * (e.g. in tests, after Setting::set()) to re-apply overrides
     * without a fresh application boot. Defensive since this can run
     * before the settings table is migrated.
     */
    public static function applyToConfig(): void
    {
        try {
            if (Schema::hasTable('settings')) {
                $overrides = static::allCached();
                if (!empty($overrides)) {
                    config(['global' => array_merge(config('global'), $overrides)]);
                }
            }
        } catch (\Throwable $e) {
            // Fall back to config/global.php defaults.
        }
    }
}
