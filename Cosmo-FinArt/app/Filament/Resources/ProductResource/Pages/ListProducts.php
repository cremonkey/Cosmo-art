<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Imports\ProductImporter;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('download_template')
                ->label('Download Template')
                ->icon('heroicon-o-document-arrow-down')
                ->color('info')
                ->action(fn () => \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\ProductTemplateExport, 'product_template.xlsx')),
            Actions\ImportAction::make()
                ->importer(ProductImporter::class),
            Actions\CreateAction::make(),
        ];
    }
}
