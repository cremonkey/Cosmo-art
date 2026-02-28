<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AboutUsSettings extends Settings
{
    public string $hero_title = '';
    public ?string $hero_image = null;
    public string $philosophy_title = '';
    public string $philosophy_content = '';
    public ?string $philosophy_image = null;
    public string $science_title = '';
    public string $science_content = '';
    public ?string $science_image = null;

    public static function group(): string
    {
        return 'about';
    }
}
