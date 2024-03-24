<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Authentication';

    public static function getNavigationGroup(): string
    {
        return trans('dashboard.authentication');
    }

    public static function getNavigationLabel(): string
    {
        return trans('dashboard.users');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('dashboard.posts');
    }

    public static function getModelLabel(): string
    {
        return trans('dashboard.users');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label(trans('dashboard.name'))
                            ->required(),

                        TextInput::make('email')
                            ->label(trans('dashboard.email'))
                            ->required()
                            ->email()
                            ->unique(table: static::$model, ignorable: fn ($record) => $record),

                        TextInput::make('password')
                            ->label(trans('dashboard.password'))
                            ->same('passwordConfirmation')
                            ->password()
                            ->maxLength(255)
                            ->required(fn ($component, $get, $livewire, $model, $record, $set, $state) => $record === null)
                            ->dehydrateStateUsing(fn ($state) => ! empty($state) ? Hash::make($state) : ''),

                        TextInput::make('passwordConfirmation')
                            ->label(trans('dashboard.password_confirmation'))
                            ->password()
                            ->dehydrated(false)
                            ->maxLength(255),

//                        Select::make('roles')
//                            ->label(trans('dashboard.roles'))
//                            ->multiple()
//                            ->relationship('roles', 'name')
//                            ->preload(config('filament-authentication.preload_roles')),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),

                TextColumn::make('name')
                    ->label(trans('dashboard.name'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label(trans('dashboard.email'))
                    ->searchable()
                    ->sortable(),

//                IconColumn::make('email_verified_at')
//                    ->options([
//                        'heroicon-o-check-circle',
//                        'heroicon-o-x-circle' => fn ($state): bool => $state === null,
//                    ])
//                    ->colors([
//                        'success',
//                        'danger' => fn ($state): bool => $state === null,
//                    ])
//                    ->label(strval(__('filament-authentication::filament-authentication.field.user.verified_at'))),

//                TagsColumn::make('roles.name')
//                    ->label(strval(__('filament-authentication::filament-authentication.field.user.roles'))),TagsColumn::make('roles.name')
//                    ->label(strval(__('filament-authentication::filament-authentication.field.user.roles'))),

                TextColumn::make('created_at')
                    ->label(trans('dashboard.created'))
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
