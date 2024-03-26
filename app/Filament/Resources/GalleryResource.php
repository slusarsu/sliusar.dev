<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Filament\Resources\GalleryResource\RelationManagers;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationGroup = 'Content';

    public static function getNavigationGroup(): string
    {
        return trans('dashboard.content');
    }

    public static function getNavigationLabel(): string
    {
        return trans('dashboard.galleries');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('dashboard.galleries');
    }

    public static function getModelLabel(): string
    {
        return trans('dashboard.gallery');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('title')
                        ->label(trans('dashboard.title'))
                        ->required()
                        ->lazy()
                        ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null),

                    TextInput::make('slug')
                        ->label(trans('dashboard.slug'))
                        ->required()
                        ->unique(self::getModel(), 'slug', ignoreRecord: true),

                    Select::make('position')
                        ->label(trans('dashboard.position'))
                        ->options(themeSettings()['gallery_positions'] ?? []),

                    TextInput::make('hash')
                        ->label(trans('dashboard.link_hash'))
                        ->required()
                        ->default(Str::random(10))
                        ->disabledOn('edit'),

                    Toggle::make('is_enabled')
                        ->label(trans('dashboard.enabled'))
                        ->default(true),
                ])->columns(2),

                Section::make('Gallery')->schema([
                    Repeater::make('items')
                        ->schema([
                            FileUpload::make('image')
                                ->directory('images')
                                ->columnSpanFull()
                                ->imageEditor(),
                            TextInput::make('alt'),
                            TextInput::make('title'),
                            TextInput::make('label'),
                            TextInput::make('order')->numeric()->default(0),
                            Textarea::make('description')->columnSpanFull(),
                            TextInput::make('button_text'),
                            TextInput::make('button_link'),
                            Toggle::make('button_is_enabled')->default(true),
                            Toggle::make('item_is_enabled')->default(true),
                        ])
                        ->collapsible()
                        ->reorderableWithButtons()
                        ->columns(2)
                ])->collapsible(),
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
                    ->label(trans('dashboard.slug'))
                    ->sortable(),

                TextColumn::make('position')
                    ->label(trans('dashboard.position'))
                    ->sortable(),

                TextColumn::make('hash')
                    ->label(trans('dashboard.link_hash'))
                    ->copyable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
