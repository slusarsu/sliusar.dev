<?php

namespace App\Filament\Pages;

use App\Services\CustomFieldService;
use App\Services\SettingService;
use App\Services\ThemeService;
use Filament\Actions\Action;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Spatie\Valuestore\Valuestore;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-adjustments-vertical';

    protected static string $view = 'filament.pages.settings';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'System';

    public ?array $data = [];
    private Valuestore $valueStore;
    /**
     * @var array|string[]
     */
    private array $parameters;

    public static function getNavigationGroup(): string
    {
        return trans('dashboard.system');
    }

    public static function getNavigationLabel(): string
    {
        return trans('dashboard.settings');
    }

    public function getTitle(): string | Htmlable
    {
        return trans('dashboard.settings');
    }

    public function __construct()
    {
        $this->valueStore = SettingService::connect();

        $this->parameters = $this->valueStore->all();
    }

    public function mount(): void
    {
        $this->form->fill($this->parameters);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Tabs::make('Setting Tabs')
                    ->tabs([
                        Tab::make('Global')
                            ->schema([
                                TextInput::make('site_name'),
                                TextInput::make('site_slogan'),
                                Textarea::make('header_codes'),
                                Textarea::make('footer_codes'),
                                Select::make('theme')
                                    ->options(
                                        resolve(ThemeService::class)->getAllTemplatesNames()
                                    )
                                    ->default('default')
                                    ->required(),
                            ]),

                        Tab::make('Home Page')
                            ->schema([
                                TextInput::make('navbar_menu_hash'),
                                TextInput::make('footer_menu_hash'),
                            ]),

                        Tab::make('SEO')
                            ->schema(CustomFieldService::fields('seo_fields')),

                        Tab::make('Values')
                            ->schema([
                                KeyValue::make('values')
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $result = $this->form->getState();

        foreach ($result as $field => $value) {
            $this->valueStore->put($field, $value);
        }

        Artisan::call('optimize:clear');

        Notification::make()
            ->title('Saved successfully')
            ->icon('heroicon-o-sparkles')
            ->iconColor('success')
            ->send();
    }

    public function getActions(): array
    {
        return [

            Action::make('Clear Cache')
                ->action(function () {
                    Artisan::call('optimize:clear');

                    Notification::make()
                        ->title('Fixed!')
                        ->success()
                        ->send();
                })
                ->requiresConfirmation()
                ->color('success'),
        ];
    }

}
