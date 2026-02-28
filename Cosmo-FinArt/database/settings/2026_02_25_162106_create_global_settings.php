<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('global.site_name', 'Cosmo Fine Art');
        $this->migrator->add('global.site_logo', null);
        $this->migrator->add('global.contact_email', 'hello@example.com');
        $this->migrator->add('global.contact_phone', '');
        $this->migrator->add('global.address', '');
        $this->migrator->add('global.social_links', []);
        $this->migrator->add('global.seo_title', null);
        $this->migrator->add('global.seo_description', null);
        $this->migrator->add('global.copyright_text', '© 2026 Cosmo Fine Art. All rights reserved.');
    }
};
