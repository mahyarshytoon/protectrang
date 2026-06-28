<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'پروژه‌ها';
    protected static ?string $pluralLabel = 'پروژه‌ها';
    protected static ?string $modelLabel = 'پروژه';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('عنوان پروژه')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label('توضیحات')
                    ->required()
                    ->rows(3),


				Forms\Components\Select::make('service_id')
					->label('تخصص مرتبط')
					->relationship('service', 'title')
					->searchable()
					->preload()
					->placeholder('انتخاب تخصص'),






                Forms\Components\Select::make('category')
                    ->label('دسته‌بندی')
                    ->options(Project::categories())
                    ->required(),
				Forms\Components\FileUpload::make('image')
						->label('عکس پروژه')
						->image()
						->directory('projects')
						->visibility('public')
						->imageResizeTargetWidth(800)
						->imageResizeTargetHeight(600)
						->imageResizeMode('cover')
						->columnSpanFull()
						->imagePreviewHeight('250')
						->loadingIndicatorPosition('left')
						->maxSize(10240)
						->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),

                Forms\Components\Toggle::make('is_active')
                    ->label('فعال')
                    ->default(true),

                Forms\Components\TextInput::make('order')
                    ->label('ترتیب نمایش')
                    ->numeric()
                    ->default(0),
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
                    ->searchable(),
					
				Tables\Columns\TextColumn::make('service.title')
					->label('تخصص')
					->badge()
					->color('info'),

                Tables\Columns\TextColumn::make('category')
                    ->label('دسته‌بندی')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'میکروسمنت' => 'info',
                        'پتینه' => 'warning',
                        'نقاشی' => 'success',
                        'اپوکسی' => 'danger',
                        'تکسچر' => 'gray',
                        default => 'secondary',
                    }),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('وضعیت')
                    ->boolean(),

                Tables\Columns\TextColumn::make('order')
                    ->label('ترتیب')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاریخ ایجاد')
                    ->dateTime('Y/m/d'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('دسته‌بندی')
                    ->options(Project::categories()),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('وضعیت'),
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
            ->defaultSort('order', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}