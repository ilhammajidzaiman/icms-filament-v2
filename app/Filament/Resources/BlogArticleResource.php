<?php

namespace App\Filament\Resources;

use Closure;
use stdClass;
use Filament\Forms;
use Filament\Tables;
use App\Models\BlogArticle;
use Illuminate\Support\Str;
use App\Models\BlogCategory;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Livewire\TemporaryUploadedFile;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BlogArticleResource\Pages;
use App\Filament\Resources\BlogArticleResource\RelationManagers;

class BlogArticleResource extends Resource
{
    protected static ?string $model = BlogArticle::class;
    protected static ?string $modelLabel = 'Artikel';
    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';
    protected static ?string $navigationGroup = 'Blog';
    protected static ?string $navigationLabel = 'Artikel';
    protected static ?string $slug = 'articles';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255)
                            ->reactive()
                            ->afterStateUpdated(function (Closure $set, $state) {
                                $set('slug', Str::slug($state));
                            }),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->disabled(),
                        RichEditor::make('content')
                            ->label('Konten')
                            ->required(),
                    ])
                    ->columnSpan(2),
                Card::make()
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Status')
                            ->required()
                            ->default('1'),
                        TextInput::make('user_id')
                            ->label('Id Penulis')
                            ->required()
                            ->maxLength(255)
                            ->default(auth()->id())
                            ->disabled(),
                        TextInput::make('visitor')
                            ->label('Pengunjung')
                            ->required()
                            ->maxLength(255)
                            ->default(0)
                            ->disabled(),
                        Select::make('blog_category_id')
                            ->label('Kategori')
                            ->required()
                            ->searchable()
                            ->reactive()
                            ->options(BlogCategory::all()->pluck('name', 'id')),
                        TagsInput::make('tags')
                            ->label('Menandai')
                            ->required()
                            ->separator(',')
                            ->suggestions(BlogCategory::all()->pluck('name')),
                        FileUpload::make('file')
                            ->label('File')
                            ->required()
                            ->maxSize(1024)
                            ->directory('article')
                            ->enableDownload()
                            ->enableOpen()
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                                return (string) str($file->getClientOriginalName())->prepend(now() . '-');
                            })
                    ])
                    ->columnSpan(1),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('#')
                    ->getStateUsing(
                        static function (stdClass $rowLoop, HasTable $livewire): string {
                            return (string) ($rowLoop->iteration +
                                ($livewire->tableRecordsPerPage * ($livewire->page - 1
                                ))
                            );
                        }
                    ),
                TextColumn::make('id')
                    ->label('Id')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('user_id')
                    ->label('Penulis')
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Judul')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('file')
                    ->label('File')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('visitor')
                    ->label('Pengunjung')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->label('Dihapus')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                ToggleColumn::make('is_active')
                    ->label('Status')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            // ->actions([
            //     Tables\Actions\EditAction::make(),
            // ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListBlogArticles::route('/'),
            'create' => Pages\CreateBlogArticle::route('/create'),
            'edit' => Pages\EditBlogArticle::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
