<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'thumbnail',
        'meta_title',
        'meta_description',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean'
    ];

    public function scopePublished($q)
    {
        return $q->where('published', true);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->title);
        });
    }
}
