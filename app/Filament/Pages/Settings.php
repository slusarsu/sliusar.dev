<?php

namespace App\Filament\Pages;

use App\Services\CustomFieldService;
use App\Services\SettingService;
use Filament\Actions\Action;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Spatie\Valuestore\Valuestore;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-adjustments-vertical';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'System';

    protected static string $view = 'filament.pages.settings';

    public ?array $data = [];
    private Valuestore $valueStore;
    /**
     * @var array|string[]
     */
    private array $parameters;

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
                                TextInput::make('site_name')
                            ]),

                        Tab::make('Home Page')
                            ->schema([

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

}
