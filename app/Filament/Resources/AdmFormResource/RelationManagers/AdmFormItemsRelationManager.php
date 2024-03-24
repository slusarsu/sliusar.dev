<?php

namespace App\Filament\Resources\AdmFormResource\RelationManagers;

use App\Enums\AdmMailStatusEnum;
use Filament\Forms;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdmFormItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'admFormItems';

    public function __construct()
    {
        self::$title = trans('dashboard.adm_form_items');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
//                TextInput::make('id')
//                    ->required()
//                    ->maxLength(255)
//                    ->columnSpanFull(),

                KeyValue::make('payload')
                    ->keyLabel('Field name')
                    ->columnSpanFull()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('id')->sortable(),

                BadgeColumn::make('status')
                    ->label(trans('dashboard.status'))
                    ->colors([
                        'primary',
                        'danger' => AdmMailStatusEnum::ERROR_SENT->value,
                        'warning' => AdmMailStatusEnum::NOT_SENT->value,
                        'success' => AdmMailStatusEnum::SENT->value,
                    ]),

                TextColumn::make('payload')
                    ->label(trans('dashboard.payload'))
                    ->limit(150, '...')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label(trans('dashboard.created'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
//                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('created_at', 'desc');
    }
}
