<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Hekmatinasser\Verta\Verta;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'نظرات';
    protected static ?string $pluralLabel = 'نظرات';
    protected static ?string $modelLabel = 'نظر';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات نظر')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('نام')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\FileUpload::make('avatar')
                            ->label('عکس پروفایل')
                            ->image()
                            ->directory('testimonials')
                            ->visibility('public')
                            ->imageResizeTargetWidth(200)
                            ->imageResizeTargetHeight(200)
                            ->imageResizeMode('cover')
                            ->imagePreviewHeight('150')
                            ->columnSpanFull(),

                        Forms\Components\Select::make('rating')
                            ->label('امتیاز')
                            ->options([
                                1 => '⭐ 1 - خیلی ضعیف',
                                2 => '⭐⭐ 2 - ضعیف',
                                3 => '⭐⭐⭐ 3 - متوسط',
                                4 => '⭐⭐⭐⭐ 4 - خوب',
                                5 => '⭐⭐⭐⭐⭐ 5 - عالی',
                            ])
                            ->required(),

                        Forms\Components\Textarea::make('comment')
                            ->label('متن نظر')
                            ->required()
                            ->rows(4),

                        Forms\Components\Textarea::make('reply')
                            ->label('پاسخ (اختیاری)')
                            ->rows(3)
                            ->helperText('پاسخ شما به این نظر'),

                        // ====== تاریخ شمسی با DatePicker ======
                        DatePicker::make('created_at')
                            ->label('تاریخ ثبت')
                            ->default(now())
                            ->locale('fa')
                            ->displayFormat('Y/m/d')
                            ->helperText('تاریخ را به‌صورت شمسی وارد کنید (مثال: ۱۴۰۳/۰۱/۰۱)'),
                    ]),

                Forms\Components\Section::make('وضعیت')
                    ->schema([
                        Forms\Components\Toggle::make('is_approved')
                            ->label('تایید شده')
                            ->default(false),

                        Forms\Components\Toggle::make('is_featured')
                            ->label('نمایش در بخش ویژه')
                            ->default(false),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')
                    ->label('عکس')
                    ->circular()
                    ->width(40)
                    ->height(40)
                    ->getStateUsing(fn ($record) => $record->avatar ? asset('storage/' . $record->avatar) : null),

                Tables\Columns\TextColumn::make('name')
                    ->label('نام')
                    ->searchable(),

                Tables\Columns\TextColumn::make('rating')
                    ->label('امتیاز')
                    ->formatStateUsing(fn ($state) => str_repeat('⭐', $state))
                    ->sortable(),

                Tables\Columns\TextColumn::make('comment')
                    ->label('نظر')
                    ->limit(50),

                ToggleColumn::make('is_approved')
                    ->label('تایید')
                    ->onIcon('heroicon-o-check-circle')
                    ->offIcon('heroicon-o-x-circle')
                    ->onColor('success')
                    ->offColor('danger'),

                // ====== نمایش تاریخ شمسی ======
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاریخ')
                    ->getStateUsing(fn ($record) => 
                        $record->created_at ? Verta::instance($record->created_at)->format('Y/m/d') : ''
                    ),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_approved')
                    ->label('وضعیت تایید'),
                Tables\Filters\SelectFilter::make('rating')
                    ->label('امتیاز')
                    ->options([
                        1 => '1 ⭐',
                        2 => '2 ⭐⭐',
                        3 => '3 ⭐⭐⭐',
                        4 => '4 ⭐⭐⭐⭐',
                        5 => '5 ⭐⭐⭐⭐⭐',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Action::make('reply')
                    ->label('پاسخ')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->modalHeading('پاسخ به نظر')
                    ->modalSubmitActionLabel('ذخیره پاسخ')
                    ->form([
                        Textarea::make('reply')
                            ->label('متن پاسخ')
                            ->required()
                            ->rows(4)
                            ->default(fn ($record) => $record->reply),
                    ])
                    ->action(function ($record, array $data) {
                        $record->update(['reply' => $data['reply']]);
                        Notification::make()
                            ->title('پاسخ با موفقیت ثبت شد')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}