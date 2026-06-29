<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'image', 'service_id', 'is_published', 'priority'];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getExcerptAttribute()
    {
        return str()->limit(strip_tags($this->content), 120);
    }
}