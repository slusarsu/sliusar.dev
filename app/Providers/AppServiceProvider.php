<?php

namespace App\Providers;

use App\Services\CustomFieldService;
use App\Services\SettingService;
use App\Services\ThemeService;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\View;
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
    public function boot(): void
    {
        View::share('settings', SettingService::values());
        View::share('themeSettings', themeSettings());

        ThemeService::getThemeFunctions(SettingService::value('theme'));

        CustomFieldService::setCustomFields('seo_fields', [
            TextInput::make('seo_title')
                ->columnSpan('full'),

            TextInput::make('seo_text_keys')
                ->columnSpan('full'),

            Textarea::make('seo_description')
                ->columnSpan('full'),
        ]);

        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['uk','en']); // also accepts a closure
        });
    }
}
