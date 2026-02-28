<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Symfony\Component\HtmlSanitizer\HtmlSanitizer;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasSEO;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'short_description',
        'description',
        'clinical_focus',
        'benefits',
        'composition',
        'protocol_summary',
        'protocol_details',
        'is_featured',
        'is_active',
        'featured_image',
        'gallery',
    ];

    protected function casts(): array
    {
        return [
            'benefits' => 'array',
            'composition' => 'array',
            'protocol_details' => 'array',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'gallery' => 'array',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function setDescriptionAttribute(?string $value): void
    {
        if ($value === null) {
            $this->attributes['description'] = null;

            return;
        }

        $config = (new HtmlSanitizerConfig())
            ->allowSafeElements()
            ->allowRelativeLinks()
            ->allowRelativeMedias();

        $sanitizer = new HtmlSanitizer($config);

        $this->attributes['description'] = $sanitizer->sanitize($value);
    }
}
