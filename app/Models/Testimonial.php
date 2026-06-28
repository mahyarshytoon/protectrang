<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Hekmatinasser\Verta\Verta;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'avatar',
        'rating',
        'comment',
        'reply',
        'is_approved',
        'is_featured',
        'created_at',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'is_featured' => 'boolean',
    ];

    // متد برای گرفتن متن رتبه
    public function getRatingLabelAttribute()
    {
        return match ($this->rating) {
            1 => 'خیلی ضعیف',
            2 => 'ضعیف',
            3 => 'متوسط',
            4 => 'خوب',
            5 => 'عالی',
            default => 'نامشخص',
        };
    }

    // متد برای گرفتن کلاس رنگ رتبه
    public function getRatingColorAttribute()
    {
        return match ($this->rating) {
            1 => 'danger',
            2 => 'warning',
            3 => 'info',
            4 => 'primary',
            5 => 'success',
            default => 'secondary',
        };
    }

    // متد برای تاریخ شمسی (خورشیدی)
    public function getCreatedAtJalaliAttribute()
    {
        return Verta::instance($this->created_at)->format('Y/m/d H:i');
    }
}