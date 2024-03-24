<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdmFormResource\Pages;
use App\Filament\Resources\AdmFormResource\RelationManagers;
use App\Models\AdmForm;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class AdmFormResource extends Resource
{
    protected static ?string $model = AdmForm::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-airplane';

    protected static ?string $navigationGroup = 'Forms';

    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): string
    {
        return trans('dashboard.adm_forms');
    }

    public static function getNavigationLabel(): string
    {
        return trans('dashboard.adm_forms');
    }

    public function getTitle(): string | Htmlable
    {
        return trans('dashboard.adm_forms');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([

                    Section::make(trans('dashboard.form_configuration'))->schema([
                        TextInput::make('title')
                            ->label(trans('dashboard.title'))
                            ->required()
                            ->lazy()
                            ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null),

                        TextInput::make('slug')
                            ->label(trans('dashboard.slug'))
                            ->required()
                            ->unique(self::getModel(), 'slug', ignoreRecord: true),

                        TextInput::make('to')
                            ->label(trans('dashboard.to')),

                        TextInput::make('subject')
                            ->label(trans('dashboard.subject')),

                        TextInput::make('cc')
                            ->label(trans('dashboard.cc'))
                            ->helperText(trans('dashboard.cc_description')),

                        TextInput::make('bcc')
                            ->label(trans('dashboard.bcc'))
                            ->helperText(trans('dashboard.bcc_description')),


                    ])->collapsible(),

                    Section::make(trans('dashboard.add_form_fields'))
                        ->schema([
                            Repeater::make('fields')
                                ->label(trans('dashboard.fields'))
                                ->schema([
                                    TextInput::make('field_name')
                                        ->label(trans('dashboard.field_name'))
                                        ->required(),
                                ])
                                ->collapsible()
                        ])
                        ->collapsed()
                        ->collapsible(),


                ])->columnSpan(3),

                Group::make()->schema([

                    Section::make()
                        ->schema([

                            TextInput::make('link_hash')
                                ->label(trans('dashboard.link_hash'))
                                ->default(Str::random(15))
                                ->disabledOn('edit'),

                            Toggle::make('is_enabled')
                                ->label(trans('dashboard.enabled'))
                                ->default(true),

                            Toggle::make('send_notify')
                                ->label(trans('dashboard.send_notify'))
                                ->default(true),
                        ]),
                ])
                    ->columnSpan(1),

            ])
            ->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')
                    ->sortable(),

                TextColumn::make('user.email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('title')
                    ->label(trans('dashboard.title'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('slug')
                    ->label(trans('dashboard.slug')),

                TextColumn::make('link_hash')
                    ->label(trans('dashboard.link_hash'))
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label(trans('dashboard.created'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AdmFormItemsRelationManager::class
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdmForms::route('/'),
            'create' => Pages\CreateAdmForm::route('/create'),
            'edit' => Pages\EditAdmForm::route('/{record}/edit'),
        ];
    }
}
