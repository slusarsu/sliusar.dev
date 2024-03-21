<?php

namespace App\Filament\Pages;

use App\Services\TranslationService;
use Filament\Actions\Action;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Arr;


class Translations extends Page  implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationGroup = 'System';
    protected static ?string $navigationIcon = 'heroicon-o-language';

    protected static string $view = 'filament.pages.translations';
    protected static ?int $navigationSort = 3;

    public ?array $data = [];
    public static function getNavigationLabel(): string
    {
        return trans('dashboard.translations');
    }

    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return trans('dashboard.translations');
    }

    public static function getNavigationGroup(): string
    {
        return trans('dashboard.view');
    }

    public function __construct()
    {

        if(!self::shouldRegisterNavigation()) {
            abort(404);
        }

        $this->translationFolders = TranslationService::getTranslationFolders();
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form->schema([

            Select::make('folder')
                ->label(trans('dashboard.folder'))
                ->live()
                ->options($this->translationFolders)
                ->afterStateUpdated(fn (Set $set) => $set('file', null)),

            Select::make('file')
                ->label(trans('dashboard.file'))
                ->live()
                ->options(function(Get $get) {
                    return TranslationService::getTranslationFilesFromFolder($get('folder'));
                })
                ->afterStateUpdated(fn (Set $set, Get $get) => $set('code', TranslationService::getTranslationArray($get('file')))),

            KeyValue::make('code')
                ->label(trans('dashboard.code'))
                ->reactive()

        ])->statePath('data');

    }

    public function submit(): void
    {
        $formData = $this->form->getLivewire()->validate();

        $result = $formData['data'];

        TranslationService::saveTranslationsArrayToFile($result['code'],$result['file']);

        Notification::make()->title('Saved successfully')->success()->send();
    }

    protected function getActions(): array
    {
        return [

            Action::make('Create File')
                ->label(trans('dashboard.create_file'))
                ->action(function (array $data): void {
                    TranslationService::createEmptyTranslationFile($data['folder'], $data['file_name']);
                    Notification::make()->title('Saved successfully')->success()->send();
                })
                ->form([
                    Select::make('folder')
                        ->label(trans('dashboard.folder'))
                        ->options($this->translationFolders)
                        ->required()
                        ->searchable(),

                    TextInput::make('file_name')
                        ->label(trans('dashboard.file_name'))
                        ->helperText('File name should be like "products" or in snake case like "main_products"'),
                ]),


            Action::make('Copy File')
                ->label(trans('dashboard.copy_file'))
                ->action(function (array $data): void {
                    TranslationService::copyTranslationFile($data);
                    Notification::make()->title('Saved successfully')->success()->send();
                })
                ->form([
                    Select::make('copy_from_folder')
                        ->label(trans('dashboard.copy_from_folder'))
                        ->options($this->translationFolders)
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(fn (callable $set) => $set('copy_from_file', null))
                        ->searchable(),

                    Select::make('copy_from_file')
                        ->label(trans('dashboard.copy_from_file'))
                        ->options(function(callable $get) {
                            return TranslationService::getTranslationFilesFromFolder($get('copy_from_folder'));
                        })
                        ->required()
                        ->searchable(),

                    Select::make('copy_to_folder')
                        ->label(trans('dashboard.copy_to_folder'))
                        ->options(function(callable $get) {
                            return Arr::where($this->translationFolders, function ($value, $key) use ($get) {
                                return $value !== $get('copy_from_folder');
                            });
                        })
                        ->required()
                        ->searchable(),
                ]),

            Action::make('Merge Files')
                ->label(trans('dashboard.merge_files'))
                ->action(function (array $data): void {
                    TranslationService::mergeTranslationFile($data);
                    Notification::make()->title('Saved successfully')->success()->send();
                })
                ->form([
                    Select::make('merge_from_folder')
                        ->label(trans('dashboard.merge_from_folder'))
                        ->options($this->translationFolders)
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(fn (callable $set) => $set('merge_from_file', null))
                        ->searchable(),

                    Select::make('merge_from_file')
                        ->label(trans('dashboard.merge_from_file'))
                        ->options(function(callable $get) {
                            return TranslationService::getTranslationFilesFromFolder($get('merge_from_folder'));
                        })
                        ->required()
                        ->searchable(),

                    Select::make('merge_to_folder')
                        ->label(trans('dashboard.merge_to_folder'))
                        ->options(function(callable $get) {
                            return Arr::where($this->translationFolders, function ($value, $key) use ($get) {
                                return $value !== $get('merge_from_folder');
                            });
                        })
                        ->required()
                        ->searchable(),

                    Select::make('merge_to_file')
                        ->label(trans('dashboard.merge_to_file'))
                        ->options(function(callable $get) {
                            return TranslationService::getTranslationFilesFromFolder($get('merge_to_folder'));
                        })
                        ->required()
                        ->searchable(),
                ]),
        ];
    }


}
