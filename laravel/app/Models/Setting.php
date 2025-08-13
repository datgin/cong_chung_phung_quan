<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company',
        'email',
        'hotline',
        'address',
        'url_zalo',
        'url_messenger',
        'url_facebook',
        'url_twitter',
        'url_youtobe',
        'map',
        'banner',
        'alt_banner',
        'link_banner',
        'logo',
        'favicon',
        'meta_title',
        'meta_description',
        'copyright',
        'script_head',
        'script_body',
        'script_footer',
        'working_time'
    ];
}
