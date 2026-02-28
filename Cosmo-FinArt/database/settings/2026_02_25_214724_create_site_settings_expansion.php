<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        // About Us Settings
        $this->migrator->add('about.hero_title', 'Where Science Meets Art.');
        $this->migrator->add('about.hero_image', null);
        $this->migrator->add('about.philosophy_title', 'Philosophy');
        $this->migrator->add('about.philosophy_content', "We believe true luxury is longevity. Our approach to cellular regeneration is rooted in precise, methodical Swedish innovation, elevating restorative nutrition into an art form.");
        $this->migrator->add('about.philosophy_image', null);
        $this->migrator->add('about.science_title', 'The Science');
        $this->migrator->add('about.science_content', "Our protocols are developed with a foundational understanding of the body's intrinsic healing capabilities, utilizing highly bioavailable nutrients to target mitochondrial decline.");
        $this->migrator->add('about.science_image', null);

        // Category Page Settings
        $this->migrator->add('category_page.showcase_title', 'Pioneering Solutions');
        $this->migrator->add('category_page.showcase_subtitle', 'Our Focus');
        $this->migrator->add('category_page.is_visible', true);

        // Product Page Settings
        $this->migrator->add('product_page.banner_title', 'Our Therapies');
        $this->migrator->add('product_page.banner_description', 'Science-led restorative treatments for cellular longevity.');
        $this->migrator->add('product_page.disclaimer_text', 'Clinical protocols are subject to professional consultation.');
    }
};
