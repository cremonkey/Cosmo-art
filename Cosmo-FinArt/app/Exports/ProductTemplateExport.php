<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Collection;

class ProductTemplateExport implements FromCollection, WithHeadings, WithStyles, WithTitle
{
    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        // Sample data row
        return collect([
            [
                'category' => 'General (Category Name)',
                'title' => 'Sample Product Name',
                'slug' => 'sample-product-slug',
                'short_description' => 'A brief summary of the product.',
                'description' => '<p>Detailed description in HTML or plain text.</p>',
                'clinical_focus' => 'Target clinical area',
                'benefits' => '["Benefit 1", "Benefit 2"]',
                'composition' => '[{"name":"Ingr 1", "description":"Desc 1"}]',
                'protocol_summary' => 'Summary of how to use.',
                'protocol_details' => '[{"step":"Step 1", "value":"Do this"}]',
                'is_featured' => '1',
                'is_active' => '1',
                'featured_image' => 'products/image-path.jpg',
                'gallery' => '["products/g-1.jpg", "products/g-2.jpg"]',
                'sort_order' => '0',
            ]
        ]);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'category',
            'title',
            'slug',
            'short_description',
            'description',
            'clinical_focus',
            'benefits',
            'composition',
            'protocol_summary',
            'protocol_details',
            'is_featured',
            'is_active',
            'featured_image',
            'gallery',
            'sort_order',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold headers
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function title(): string
    {
        return 'Products Template';
    }
}
