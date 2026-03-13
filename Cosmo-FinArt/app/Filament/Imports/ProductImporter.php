<?php

namespace App\Filament\Imports;

use App\Models\Product;
use App\Models\Category;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;
use Illuminate\Support\Str;

class ProductImporter extends Importer
{
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('category')->requiredMapping(),
            ImportColumn::make('title')->requiredMapping(),
            ImportColumn::make('slug')->requiredMapping(),
            ImportColumn::make('short_description')->requiredMapping(),
            ImportColumn::make('description')->requiredMapping(),
            ImportColumn::make('clinical_focus'),
            ImportColumn::make('benefits'),
            ImportColumn::make('composition'),
            ImportColumn::make('protocol_summary'),
            ImportColumn::make('protocol_details'),
            ImportColumn::make('is_featured')->requiredMapping(),
            ImportColumn::make('is_active')->requiredMapping(),
            ImportColumn::make('featured_image'),
            ImportColumn::make('gallery'),
            ImportColumn::make('sort_order'),
        ];
    }

    public function resolveRecord(): Product
    {
        $logPath = base_path('debug_import.log');
        $timestamp = date('Y-m-d H:i:s');
        
        try {
            file_put_contents($logPath, "\n[{$timestamp}] --- Start Row Processing ---\n", FILE_APPEND);
            file_put_contents($logPath, "[{$timestamp}] Data: " . json_encode($this->data) . "\n", FILE_APPEND);

            if (empty($this->data['slug'])) {
                 file_put_contents($logPath, "[{$timestamp}] ERROR: Missing slug\n", FILE_APPEND);
                 throw new \Exception("Missing slug for row");
            }

            $product = Product::firstOrNew([
                'slug' => $this->data['slug'],
            ]);

            // Manual Mapping to be 100% sure
            $product->title = $this->data['title'] ?? 'No Title';
            $product->short_description = $this->data['short_description'] ?? 'No Description';
            $product->description = $this->data['description'] ?? 'No Description';
            $product->clinical_focus = $this->data['clinical_focus'] ?? null;
            
            // Handle JSON fields safely
            $product->benefits = $this->decodeJson($this->data['benefits'] ?? null);
            $product->composition = $this->decodeJson($this->data['composition'] ?? null);
            $product->protocol_summary = $this->data['protocol_summary'] ?? null;
            $product->protocol_details = $this->decodeJson($this->data['protocol_details'] ?? null);
            $product->gallery = $this->decodeJson($this->data['gallery'] ?? null);

            // Handle Boolean fields
            $product->is_featured = filter_var($this->data['is_featured'] ?? 0, FILTER_VALIDATE_BOOLEAN);
            $product->is_active = filter_var($this->data['is_active'] ?? 1, FILTER_VALIDATE_BOOLEAN);

            // Handle Numeric/String fields
            $product->featured_image = $this->data['featured_image'] ?? null;
            $product->sort_order = (int)($this->data['sort_order'] ?? 0);

            // Handle Category manually
            $categoryState = $this->data['category'] ?? 'General';
            $category = null;

            if (is_numeric($categoryState)) {
                $category = Category::find($categoryState);
            }
            
            if (!$category) {
                $category = Category::firstOrCreate([
                    'name' => $categoryState,
                ], [
                    'slug' => Str::slug($categoryState),
                    'description' => 'Auto-generated category from import',
                    'is_active' => true,
                ]);
            }

            if ($category) {
                $product->category_id = $category->id;
                file_put_contents($logPath, "[{$timestamp}] Category Resolved: {$category->name} (ID: {$category->id})\n", FILE_APPEND);
            }

            file_put_contents($logPath, "[{$timestamp}] Attempting to Save Product...\n", FILE_APPEND);
            
            if ($product->save()) {
                file_put_contents($logPath, "[{$timestamp}] SUCCESS: Product Saved (ID: {$product->id})\n", FILE_APPEND);
            } else {
                file_put_contents($logPath, "[{$timestamp}] FAILED: Eloquent save() returned false\n", FILE_APPEND);
            }
            
            return $product;

        } catch (\Exception $e) {
            file_put_contents($logPath, "[{$timestamp}] CRITICAL ERROR in resolveRecord: " . $e->getMessage() . "\n", FILE_APPEND);
            return null; 
        }
    }

    protected function decodeJson($value)
    {
        if (empty($value)) return null;
        if (is_array($value)) return $value;
        
        $decoded = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $decoded;
        }
        
        // If not valid JSON, return as is or as array if it looks like one
        return $value;
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
