<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class CategoryPageSettings extends Settings
{
    public string $showcase_title = 'Pioneering Solutions';
    public string $showcase_subtitle = 'Our Focus';
    public bool $is_visible = true;

    public static function group(): string
    {
        return 'category_page';
    }
}
