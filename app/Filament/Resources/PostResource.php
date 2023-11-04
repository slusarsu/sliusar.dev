<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use App\Models\Tag;
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

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->lazy()
                            ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null)
                            ->columnSpanFull(),

                        TextInput::make('slug')
                            ->required()
                            ->unique(self::getModel(), 'slug', ignoreRecord: true)
                            ->columnSpanFull(),

                        TinyEditor::make('short')
                            ->fileAttachmentsDisk('local')
                            ->fileAttachmentsVisibility('storage')
                            ->fileAttachmentsDirectory('public/images')
                            ->setConvertUrls(false),

                        TinyEditor::make('content')
                            ->fileAttachmentsDisk('local')
                            ->fileAttachmentsVisibility('storage')
                            ->fileAttachmentsDirectory('public/images')
                            ->setConvertUrls(false)
                    ]),

                Tabs::make('Heading')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('setting')
                            ->icon('heroicon-o-folder')
                            ->schema([

                                Select::make('category_id')
                                    ->preload()
                                    ->relationship('category', 'title'),

                                DateTimePicker::make('created_at')
                                    ->default(Carbon::now()),

                                Select::make('tags')
                                    ->multiple()
                                    ->preload()
                                    ->relationship('tags', 'title')
                                    ->createOptionForm([
                                        TextInput::make('title')
                                            ->required()
                                            ->lazy()
                                            ->unique(Tag::class, 'title', ignoreRecord: true)
                                            ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'createOption' ? $set('slug', Str::slug($state)) : null),

                                        TextInput::make('slug')
                                            ->required()
                                            ->unique(Tag::class, 'slug', ignoreRecord: true),

                                    ]),

                                Toggle::make('is_enabled')
                                    ->default(true),

                            ])->columns(2),

                        Tab::make('Images')
                            ->icon('heroicon-o-film')
                            ->schema([
                                FileUpload::make('thumb')
                                    ->directory('images')
                                    ->image(),

                                FileUpload::make('images')
                                    ->directory('images')->multiple()->image()
                            ])  ,

                        Tab::make('Custom Fields')
                            ->icon('heroicon-o-document-text')
                            ->schema(function($record) {

                                if(empty($record)) {
                                    return [];
                                }

                                return CustomFieldService::fields('post');
                            }),

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

                ToggleColumn::make('is_enabled'),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('category.title')
                    ->sortable(),

                TextColumn::make('slug'),

                TextColumn::make('created_at')
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
