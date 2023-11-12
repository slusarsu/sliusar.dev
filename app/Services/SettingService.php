<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Spatie\Valuestore\Valuestore;

class SettingService
{
    public static function connect()
    {
        if(!File::exists(storage_path('settings'))) {
            File::makeDirectory(storage_path('settings'));
            File::put(storage_path('settings/site_setting.json'), '{}');
        }

        return Valuestore::make(storage_path('settings/site_setting.json'));
    }

    public static function values(): array
    {
        return static::connect()->all();
    }

    public static function value(string $value)
    {
        return static::connect()->get($value) ?? '';
    }
}
