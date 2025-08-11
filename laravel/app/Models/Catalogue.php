<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Catalogue extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'position',
        'published',
        'slider_title',
        'is_slider',
        'meta_title',
        'meta_description'
    ];

    protected $casts = [
        'published' => 'boolean',
        'is_slider' => 'boolean'
    ];

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }
}
