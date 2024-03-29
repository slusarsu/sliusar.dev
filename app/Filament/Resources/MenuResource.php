<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Models\Menu;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
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
use Str;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3';
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'View';

    public static function getNavigationGroup(): string
    {
        return trans('dashboard.view');
    }

    public static function getNavigationLabel(): string
    {
        return trans('dashboard.menus');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('dashboard.menus');
    }

    public static function getModelLabel(): string
    {
        return trans('dashboard.menu');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('title')
                        ->label(trans('dashboard.title'))
                        ->required(),

                    TextInput::make('hash')
                        ->label(trans('dashboard.link_hash'))
                        ->default(Str::random(15))
                        ->disabledOn('edit'),

                    Select::make('position')
                        ->label(trans('dashboard.position'))
                        ->options(themeSettings()['menu_positions'] ?? []),

                    Repeater::make('links')
                        ->label(trans('dashboard.links'))
                        ->schema([
                            TextInput::make('text')->label(trans('dashboard.text')),
                            TextInput::make('url')->label(trans('dashboard.url')),
                            Toggle::make('blank')
                                ->default(true),
                            Toggle::make('is_enabled')
                                ->label(trans('dashboard.enabled'))
                                ->default(true),
                        ])
                        ->columnSpanFull()
                        ->columns(2),

                    Toggle::make('is_enabled')
                                    ->label(trans('dashboard.enabled'))
                        ->columnSpanFull()
                        ->default(true),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),

                TextColumn::make('title')
                    ->label(trans('dashboard.title'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('hash')
                    ->label(trans('dashboard.link_hash'))
                    ->copyable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(trans('dashboard.created'))
                    ->date()
                    ->sortable(),

                ToggleColumn::make('is_enabled')
                    ->label(trans('dashboard.enabled')),
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
