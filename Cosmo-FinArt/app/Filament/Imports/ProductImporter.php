<?php

namespace App\Filament\Imports;

use App\Models\Product;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class ProductImporter extends Importer
{
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('category')
                ->requiredMapping()
                ->relationship(resolveUsing: function (string $state) {
                    if (is_numeric($state)) {
                        $category = \App\Models\Category::find($state);
                        if ($category) {
                            return $category->id;
                        }
                    }

                    return \App\Models\Category::firstOrCreate([
                        'name' => $state,
                    ], [
                        'slug' => \Illuminate\Support\Str::slug($state),
                        'description' => 'Auto-generated category from import',
                        'is_active' => true,
                    ])->id;
                })
                ->rules(['required']),
            ImportColumn::make('title')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('slug')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('short_description')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('description')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('clinical_focus')
                ->rules(['nullable', 'max:255']),
            ImportColumn::make('benefits')
                ->rules(['nullable', 'json']),
            ImportColumn::make('composition')
                ->rules(['nullable', 'json']),
            ImportColumn::make('protocol_summary')
                ->rules(['nullable']),
            ImportColumn::make('protocol_details')
                ->rules(['nullable', 'json']),
            ImportColumn::make('is_featured')
                ->requiredMapping()
                ->boolean()
                ->rules(['required', 'boolean']),
            ImportColumn::make('is_active')
                ->requiredMapping()
                ->boolean()
                ->rules(['required', 'boolean']),
            ImportColumn::make('featured_image')
                ->rules(['nullable', 'max:255']),
            ImportColumn::make('gallery')
                ->rules(['nullable', 'json']),
            ImportColumn::make('sort_order')
                ->numeric()
                ->rules(['nullable', 'integer']),
        ];
    }

    public function resolveRecord(): Product
    {
        // Handle duplicates based on slug
        return Product::firstOrNew([
            'slug' => $this->data['slug'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your product import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
