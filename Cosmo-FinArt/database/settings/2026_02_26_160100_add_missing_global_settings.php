<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        if (! $this->migrator->exists('global.meta_keywords')) {
            $this->migrator->add('global.meta_keywords', []);
        }

        if (! $this->migrator->exists('global.favicon')) {
            $this->migrator->add('global.favicon', null);
        }
    }
};

