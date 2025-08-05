<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'catalogue_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'thumbnail',
        'meta_title',
        'meta_description',
        'published',
        'published_at'
    ];

    protected $casts = [
        'published' => 'boolean',
        'published_at' => 'datetime'
    ];

    public function catalogue()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->title);
        });
    }
}
