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

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Content';

    public static function getNavigationGroup(): string
    {
        return trans('dashboard.content');
    }

    public static function getNavigationLabel(): string
    {
        return trans('dashboard.posts');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('dashboard.posts');
    }

    public static function getModelLabel(): string
    {
        return trans('dashboard.post');
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

                                Select::make('category_id')
                                    ->label(trans('dashboard.category'))
                                    ->preload()
                                    ->relationship('category', 'title'),

                                DateTimePicker::make('created_at')
                                    ->label(trans('dashboard.created'))
                                    ->default(Carbon::now()),

                                Select::make('tags')
                                    ->label(trans('dashboard.tags'))
                                    ->multiple()
                                    ->preload()
                                    ->relationship('tags', 'title')
                                    ->createOptionForm([
                                        TextInput::make('title')
                                            ->label(trans('dashboard.title'))
                                            ->required()
                                            ->lazy()
                                            ->unique(Tag::class, 'title', ignoreRecord: true)
                                            ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'createOption' ? $set('slug', Str::slug($state)) : null),

                                        TextInput::make('slug')
                                            ->label(trans('dashboard.slug'))
                                            ->required()
                                            ->unique(Tag::class, 'slug', ignoreRecord: true),

                                    ]),

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
                                    ->imageEditor()
                                    ->image(),

                                FileUpload::make('images')
                                    ->label(trans('dashboard.images'))
                                    ->directory('images')
                                    ->multiple()
                                    ->image()
                            ])  ,

                        Tab::make('Custom Fields')
                            ->label(trans('dashboard.custom_fields'))
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

                TextColumn::make('views')
                    ->sortable()
                    ->label(trans('dashboard.views')),

                ToggleColumn::make('is_enabled')
                    ->label(trans('dashboard.enabled')),

                TextColumn::make('title')
                    ->label(trans('dashboard.title'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('category.title')
                    ->label(trans('dashboard.category'))
                    ->sortable(),

                TextColumn::make('slug')
                    ->label(trans('dashboard.slug')),

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
            ])->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\CommentsRelationManager::class,
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
