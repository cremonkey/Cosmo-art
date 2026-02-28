<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Livewire Component Namespace
    |--------------------------------------------------------------------------
    |
    | Filament serializes components as full kebab-case namespaces like:
    | "app.filament.resources.product-resource.pages.create-product".
    | Setting this to an empty string allows Livewire to resolve these names
    | directly to "App\Filament\Resources\...\CreateProduct".
    |
    */
    'class_namespace' => '',

    /*
    |--------------------------------------------------------------------------
    | Temporary File Uploads
    |--------------------------------------------------------------------------
    |
    | Keep temporary uploads on the local/private disk to avoid public-disk
    | drift and ensure metadata checks are stable during form validation.
    |
    */
    'temporary_file_upload' => [
        'disk' => 'local',
        'directory' => 'livewire-tmp',
        'cleanup' => false,
        'max_upload_time' => 30,
    ],
];
