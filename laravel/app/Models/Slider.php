<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'width',
        'height',
        'slides_per_view',
        'loop',
        'autoplay',
        'autoplay_delay',
        'pagination',
        'navigation',
        'effect',
        'space_between',
        'items'
    ];

    protected $casts = [
        'items' => 'array',
        'loop' => 'boolean',
        'autoplay' => 'boolean',
        'pagination' => 'boolean',
        'navigation' => 'boolean',
    ];
}
