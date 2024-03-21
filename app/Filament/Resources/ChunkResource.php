<?php

namespace App\Filament\Resources;

use App\Enums\ChunkTypeEnum;
use App\Filament\Resources\ChunkResource\Pages;
use App\Filament\Resources\ChunkResource\RelationManagers;
use App\Models\Chunk;
use Filament\Forms;
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
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Riodwanto\FilamentAceEditor\AceEditor;

class ChunkResource extends Resource
{
    protected static ?string $model = Chunk::class;

    protected static ?string $navigationIcon = 'heroicon-o-code-bracket-square';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'View';

    public static function getNavigationGroup(): string
    {
        return trans('dashboard.view');
    }

    public static function getNavigationLabel(): string
    {
        return trans('dashboard.chunks');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('dashboard.chunks');
    }

    public static function getModelLabel(): string
    {
        return trans('dashboard.chunk');
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

                    Select::make('type')
                        ->label(trans('dashboard.type'))
                        ->options(
                            ChunkTypeEnum::allValues()
                        )->required(),

                    Select::make('position')
                        ->label(trans('dashboard.position'))
                        ->options(themeSettings()['chunk_positions'] ?? []),

                    TextInput::make('order')
                        ->numeric()
                        ->default(1),

                    AceEditor::make('body')
                        ->label(trans('dashboard.body'))
                        ->mode('html')
                        ->theme('github')
                        ->darkTheme('dracula')
                        ->columnSpanFull(),

                    Toggle::make('is_enabled')->default(true),

                ])->columns(2)
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

                TextColumn::make('slug')
                    ->label(trans('dashboard.slug'))
                    ->copyable(),

                TextColumn::make('position')
                    ->label(trans('dashboard.slug'))
                    ->copyable(),

                TextColumn::make('order')
                    ->label(trans('dashboard.order')),

                TextColumn::make('created_at')
                    ->label(trans('dashboard.created'))
                    ->dateTime('d.m.Y H:i')
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
            'index' => Pages\ListChunks::route('/'),
            'create' => Pages\CreateChunk::route('/create'),
            'edit' => Pages\EditChunk::route('/{record}/edit'),
        ];
    }
}
