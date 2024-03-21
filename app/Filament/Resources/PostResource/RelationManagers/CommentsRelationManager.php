<?php

namespace App\Filament\Resources\PostResource\RelationManagers;

use App\Models\Comment;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Attributes\Locked;

class CommentsRelationManager extends RelationManager
{
    protected static string $relationship = 'comments';

    #[Locked]
    public Model $ownerRecord;

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return trans('dashboard.comments');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->label(trans('dashboard.email'))
                    ->email(true)
                    ->maxLength(255)
                    ->columnSpanFull(),

                Textarea::make('content')
                    ->label(trans('dashboard.content'))
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('parent_id')
                    ->label(trans('dashboard.parent'))
                    ->numeric(true)
                    ->columnSpanFull(),

                Toggle::make('is_enabled')
                    ->label(trans('dashboard.enabled'))
                    ->default(false)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('id'),

                TextColumn::make('email')
                    ->label(trans('dashboard.email'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('content')
                    ->label(trans('dashboard.content'))
                    ->limit(150, '...')
                    ->searchable(),

                TextColumn::make('ip')
                    ->sortable(),

                IconColumn::make('is_enabled')
                    ->label(trans('dashboard.enabled'))
                    ->boolean()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(trans('dashboard.created'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Filter::make('only_enabled')
                    ->label(trans('dashboard.only_enabled'))
                    ->query(fn (Builder $query): Builder => $query->where('is_enabled', true))
                    ->toggle(),

                SelectFilter::make('email')
                    ->label(trans('dashboard.email'))
                    ->options(
                        Comment::query()->pluck('email', 'email')->unique()->toArray()
                    )
                    ->searchable()
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
