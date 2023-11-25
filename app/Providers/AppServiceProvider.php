<?php

namespace App\Providers;

use App\Services\CustomFieldService;
use App\Services\SettingService;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrapFive();

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
                DatePicker::make('start_date')->format('d M Y'),
                DatePicker::make('end_date')->format('d M Y'),
                TextInput::make('period'),
                Select::make('technologies')->multiple()->options([
                    'PHP' => 'PHP',
                    'MySQL' => 'MySQL',
                    'Laravel' => 'Laravel',
                    'CSS' => 'CSS',
                    'HTML' => 'HTML',
                    'JavaScript' => 'JavaScript',
                    'Bootstrap' => 'Bootstrap',
                    'LiveWire' => 'LiveWire',
                    'Vue 2' => 'Vue 2',
                    'Alpine js' => 'Alpine js',
                    'jQuery' => 'jQuery',
                    'Linux' => 'Linux',
                    'OS' => 'OS',
                    'Network' => 'Network',
                    'Computer Science' => 'Computer Science',
                    'SCL PLC programming' => 'SCL PLC programming',
                ])->columnSpan('full'),
            ])->columns(2)
        ]);
    }
}
