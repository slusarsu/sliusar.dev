<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use App\Services\CustomFieldService;
use App\Services\PageService;
use Carbon\Carbon;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Str;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?int $navigationSort = 0;

    protected static ?string $navigationGroup = 'Content';

    public static function getNavigationGroup(): string
    {
        return trans('dashboard.content');
    }

    public static function getNavigationLabel(): string
    {
        return trans('dashboard.pages');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('dashboard.pages');
    }

    public static function getModelLabel(): string
    {
        return trans('dashboard.page');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('title')
                            ->label(trans('dashboard.title'))
                            ->required()
                            ->lazy()
                            ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null)
                            ->columnSpanFull(),

                        TextInput::make('slug')
                            ->label(trans('dashboard.slug'))
                            ->required()
                            ->unique(self::getModel(), 'slug', ignoreRecord: true)
                            ->columnSpanFull(),

                        TinyEditor::make('short')
                            ->label(trans('dashboard.short'))
                            ->fileAttachmentsDisk('local')
                            ->fileAttachmentsVisibility('storage')
                            ->fileAttachmentsDirectory('public/images')
                            ->setConvertUrls(false),

                        TinyEditor::make('content')
                            ->label(trans('dashboard.content'))
                            ->fileAttachmentsDisk('local')
                            ->fileAttachmentsVisibility('storage')
                            ->fileAttachmentsDirectory('public/images')
                            ->setConvertUrls(false)
                    ]),

                Tabs::make('Heading')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('setting')
                            ->label(trans('dashboard.settings'))
                            ->icon('heroicon-o-folder')
                            ->schema([

                                Select::make('template')
                                    ->options(PageService::getListOfPageTemplates())
                                    ->default('page')
                                    ->required(),

                                DateTimePicker::make('created_at')
                                    ->label(trans('dashboard.created'))
                                    ->default(Carbon::now()),

                                Toggle::make('is_enabled')
                                    ->label(trans('dashboard.enabled'))
                                    ->default(true),
                            ])->columns(2),

                        Tab::make('Images')
                            ->label(trans('dashboard.images'))
                            ->icon('heroicon-o-film')
                            ->schema([
                                FileUpload::make('thumb')
                                    ->label(trans('dashboard.thumb'))
                                    ->directory('images')
                                    ->image(),

                                FileUpload::make('images')
                                    ->label(trans('dashboard.images'))
                                    ->directory('images')->multiple()->image()
                            ])  ,

                        Tab::make('Custom Fields')
                            ->label(trans('dashboard.custom_fields'))
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Select::make('custom_fields.fields_set')
                                    ->live()
                                    ->options( CustomFieldService::fieldsSet()),

                                Section::make()
                                    ->hidden(fn (Get $get): bool => ! $get('custom_fields.fields_set'))
                                    ->schema(function(Get $get) {
                                        if($get('custom_fields.fields_set')) {
                                            return CustomFieldService::fields($get('custom_fields.fields_set')) ?? [];
                                        }
                                        return [];
                                    }),
                            ]),

                        Tab::make('SEO')
                            ->icon('heroicon-o-folder')
                            ->schema(CustomFieldService::fields('seo_fields')),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),

                ToggleColumn::make('is_enabled')
                    ->label(trans('dashboard.enabled')),

                TextColumn::make('title')
                    ->label(trans('dashboard.title'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('slug')
                    ->label(trans('dashboard.slug')),

                TextColumn::make('template')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(trans('dashboard.created'))
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Filter::make('Only enabled')
                    ->query(fn (Builder $query): Builder => $query->where('is_enabled', true))
                    ->toggle()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
