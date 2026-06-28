<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'service_id',  // <-- اضافه شد
        'image',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // رابطه با سرویس
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // دسته‌بندی‌های قبلی (برای فیلتر)
    public static function categories()
    {
        return [
            'میکروسمنت' => 'میکروسمنت',
            'پتینه' => 'پتینه',
            'نقاشی' => 'نقاشی',
            'اپوکسی' => 'اپوکسی',
            'تکسچر' => 'تکسچر',
        ];
    }
}