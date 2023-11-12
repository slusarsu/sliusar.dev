<?php

namespace App\Providers;

use App\Services\CustomFieldService;
use App\Services\SettingService;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
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

        CustomFieldService::setCustomFields('seo_fields', [
            TextInput::make('seo_title')
                ->columnSpan('full'),

            TextInput::make('seo_text_keys')
                ->columnSpan('full'),

            Textarea::make('seo_description')
                ->columnSpan('full'),
        ]);

        CustomFieldService::setCustomFields('about', [
            RichEditor::make('custom_fields.education')
                ->columnSpan('full'),

            Repeater::make('custom_fields.jobs')->schema([
                TextInput::make('position'),
                TextInput::make('company'),
                RichEditor::make('description')
                    ->columnSpan('full'),
                DateTimePicker::make('start_date')->date(),
                DateTimePicker::make('end_date')->date(),
            ])->columns(2)
        ]);
    }
}
