<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'وبلاگ';
    protected static ?string $pluralLabel = 'وبلاگ';
    protected static ?string $modelLabel = 'پست';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات پست')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('عنوان')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('slug')
                            ->label('اسلاگ')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Forms\Components\Select::make('service_id')
                            ->label('دسته‌بندی')
                            ->relationship('service', 'title')
                            ->required()
                            ->searchable()
                            ->preload(),

                        Forms\Components\FileUpload::make('image')
                            ->label('عکس')
                            ->image()
                            ->directory('blog')
                            ->visibility('public')
                            ->imageResizeTargetWidth(600)
                            ->imageResizeTargetHeight(400)
                            ->imageResizeMode('cover')
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('content')
                            ->label('محتوا')
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('excerpt')
                            ->label('خلاصه')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('author')
                            ->label('نویسنده')
                            ->maxLength(255)
                            ->default('نویسنده'),

                        Forms\Components\Toggle::make('is_published')
                            ->label('منتشر شده')
                            ->default(true),

                        Forms\Components\Toggle::make('is_featured')
                            ->label('ویژه'),

                        Forms\Components\TextInput::make('priority')
                            ->label('اولویت')
                            ->numeric()
                            ->default(0)
                            ->helperText('عدد کمتر = نمایش بالاتر'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('عکس')
                    ->circular()
                    ->width(50)
                    ->height(50)
                    ->getStateUsing(fn ($record) => $record->image ? asset('storage/' . $record->image) : null),

                Tables\Columns\TextColumn::make('title')
                    ->label('عنوان')
                    ->searchable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('service.title')
                    ->label('دسته‌بندی')
                    ->badge()
                    ->color('info'),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('منتشر شده')
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('ویژه')
                    ->boolean(),

                Tables\Columns\TextColumn::make('priority')
                    ->label('اولویت')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاریخ')
                    ->dateTime('Y/m/d'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('service_id')
                    ->label('دسته‌بندی')
                    ->relationship('service', 'title'),
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('وضعیت انتشار'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('priority', 'asc');
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