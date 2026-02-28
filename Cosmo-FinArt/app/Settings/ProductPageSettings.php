<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ProductPageSettings extends Settings
{
    public string $banner_title = 'Our Therapies';
    public string $banner_description = 'Science-led restorative treatments for cellular longevity.';
    public string $disclaimer_text = 'Clinical protocols are subject to professional consultation.';

    public static function group(): string
    {
        return 'product_page';
    }
}
