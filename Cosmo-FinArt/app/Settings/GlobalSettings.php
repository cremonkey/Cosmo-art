<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GlobalSettings extends Settings
{
    public string $site_name = 'Cosmo FinArt';
    public ?string $site_logo = null;
    public string $contact_email = 'info@cosmo-finart.com';
    public string $contact_phone = '';
    public string $address = '';
    public array $social_links = [];
    public ?string $seo_title = null;
    public ?string $seo_description = null;
    public array $meta_keywords = [];
    public ?string $favicon = null;
    public string $copyright_text = '© 2026 Cosmo FinArt. All rights reserved.';

    public static function group(): string
    {
        return 'global';
    }
}
