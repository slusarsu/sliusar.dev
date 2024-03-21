<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use App\Services\CustomFieldService;
use App\Services\PageService;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
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

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-wallet';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Content';

    public static function getNavigationGroup(): string
    {
        return trans('dashboard.content');
    }

    public static function getNavigationLabel(): string
    {
        return trans('dashboard.categories');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('dashboard.categories');
    }

    public static function getModelLabel(): string
    {
        return trans('dashboard.category');
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

                                TextInput::make('order')
                                    ->integer(true)
                                    ->default(0),

                                Select::make('parent_id')
                                    ->options(function($record) {
                                        if($record) {
                                            return Category::query()
                                                ->whereNot('id', $record->id)
                                                ->pluck('title', 'id');
                                        }
                                        return Category::query()
                                            ->pluck('title', 'id');
                                    })
                                    ->searchable(),

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

                TextColumn::make('order')
                    ->sortable(),

                TextColumn::make('parent.title')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(trans('dashboard.created'))
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Filter::make('only_enabled')
                    ->label(trans('dashboard.only_enabled'))
                    ->query(fn (Builder $query): Builder => $query->where('is_enabled', true))
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('order', 'asc');
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
