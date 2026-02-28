<?php

namespace App\Filament\Resources\Abouts\Pages;

use App\Filament\Resources\Abouts\AboutResource;
use App\Models\About;
use Filament\Resources\Pages\CreateRecord;

class CreateAbout extends CreateRecord
{
    protected static string $resource = AboutResource::class;

    public function mount(): void
    {
        $record = About::query()->latest('id')->first();

        if ($record) {
            $this->redirect(static::$resource::getUrl('edit', ['record' => $record]));

            return;
        }

        parent::mount();
    }
}
