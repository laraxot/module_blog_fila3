<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Modules\Blog\Filament\Resources\PostResource\Pages;
use Modules\Blog\Models\Post;
use Modules\Blog\Traits\HasContentEditor;
use Savannabits\FilamentModules\Concerns\ContextualResource;

class PostResource extends Resource
{
    use ContextualResource;
    use HasContentEditor;

    protected static ?string $model = Post::class;

    // protected static ?string $slug = 'blog/posts';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    // protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        $locale = session()->get('locale') ?? request()->get('locale') ?? request()->cookie('filament_language_switch_locale') ?? config('app.locale', 'en');
        // dddx(['locale' => $locale, 'app_locale' => app()->getLocale()]);
        App::setLocale($locale);

        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        /*
                        Forms\Components\Select::make('lang')
                            ->reactive()
                            ->options(['it' => 'it', 'en' => 'en', 'fr' => 'fr', 'de' => 'de'])
                            ->afterStateUpdated(function ($state, callable $set) {
                                App::setLocale($state);
                            })
                            ->default('it'),
                        */
                        Forms\Components\TextInput::make('title')
                            ->label(__('filament-blog::filament-blog.title'))
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->label(__('filament-blog::filament-blog.slug'))
                            ->disabled()
                            ->required()
                            ->unique(Post::class, 'slug', fn ($record) => $record),

                        Forms\Components\Textarea::make('excerpt')
                            ->label(__('filament-blog::filament-blog.excerpt'))
                            ->rows(2)
<<<<<<< HEAD
                            // ->minLength(50)
=======
                            //->minLength(50)
>>>>>>> 0aa419f (up)
                            ->maxLength(1000)
                            ->columnSpan([
                                'sm' => 2,
                            ]),

                        Forms\Components\FileUpload::make('banner')
                            ->label(__('filament-blog::filament-blog.banner'))
                            ->image()
                            ->maxSize(config('filament-blog.banner.maxSize', 5120))
                            ->imageCropAspectRatio(config('filament-blog.banner.cropAspectRatio', '16:9'))
                            ->disk(config('filament-blog.banner.disk', 'public'))
                            ->directory(config('filament-blog.banner.directory', 'blog'))
                            ->columnSpan([
                                'sm' => 2,
                            ]),

                        // self::getContentEditor('content'),

                        \Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor::make('content')
                        ->profile('demo')
                        ->template('icons')
                        ->columnSpan([
                            'sm' => 2,
                        ]),

                        Forms\Components\BelongsToSelect::make('blog_author_id')
                            ->label(__('filament-blog::filament-blog.author'))
                            ->relationship('author', 'name')
                            ->searchable()
<<<<<<< HEAD
                        // ->required()
                        ,
=======
                            //->required()
                            ,
>>>>>>> 0aa419f (up)

                        Forms\Components\BelongsToSelect::make('blog_category_id')
                            ->label(__('filament-blog::filament-blog.category'))
                            ->relationship('category', 'name')
                            ->searchable()
<<<<<<< HEAD
                        // ->required()
                        ,
=======
                            //->required()
                            ,
>>>>>>> 0aa419f (up)

                        Forms\Components\DatePicker::make('published_at')
                            ->label(__('filament-blog::filament-blog.published_date')),
                        SpatieTagsInput::make('tags')
                            ->label(__('filament-blog::filament-blog.tags'))
                            //->required()
                            ,
                    ])
                    ->columns([
                        'sm' => 2,
                    ])
                    ->columnSpan(2),
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label(__('filament-blog::filament-blog.created_at'))
                            ->content(fn (
                                ?Post $record
                            ): string => $record ? $record->created_at->diffForHumans() : '-'),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label(__('filament-blog::filament-blog.last_modified_at'))
                            ->content(fn (
                                ?Post $record
                            ): string => $record ? $record->updated_at->diffForHumans() : '-'),
                    ])
                    ->columnSpan(1),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('banner')
                    ->label(__('filament-blog::filament-blog.banner'))
                    ->rounded(),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament-blog::filament-blog.title'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('author.name')
                    ->label(__('filament-blog::filament-blog.author_name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label(__('filament-blog::filament-blog.category_name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label(__('filament-blog::filament-blog.published_at'))
                    ->date(),
            ])
            ->filters([
                Tables\Filters\Filter::make('published_at')
                    ->form([
                        Forms\Components\DatePicker::make('published_from')
                            ->placeholder(fn ($state): string => 'Dec 18, '.\now()->subYear()->format('Y')),
                        Forms\Components\DatePicker::make('published_until')
                            ->placeholder(fn ($state): string => \now()->format('M d, Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['published_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '>=', $date),
                            )
                            ->when(
                                $data['published_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '<=', $date),
                            );
                    }),
            ]);
    }

    public static function getRelations(): array
    {
        return [
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

    protected static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['author', 'category']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'slug', 'author.name', 'category.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->author) {
            $details['Author'] = $record->author->name;
        }

        if ($record->category) {
            $details['Category'] = $record->category->name;
        }

        return $details;
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament-blog::filament-blog.posts');
    }

    public static function getModelLabel(): string
    {
        return __('filament-blog::filament-blog.post');
    }
}
