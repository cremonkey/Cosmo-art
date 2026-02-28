<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'hero_title',
        'hero_text',
        'hero_image',
        'philosophy_subtitle',
        'philosophy_title',
        'philosophy_content',
        'philosophy_image',
        'science_title',
        'science_content',
        'science_image',
        'showcase_title',
        'showcase_subtitle',
        'is_visible',
        'banner_title',
        'banner_description',
        'disclaimer_text',
        'infographics',
    ];

    protected function casts(): array
    {
        return [
            'infographics' => 'array',
            'is_visible' => 'boolean',
        ];
    }
}
