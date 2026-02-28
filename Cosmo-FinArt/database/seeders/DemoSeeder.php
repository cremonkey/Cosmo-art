<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class DemoSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Nutrition',
                'slug' => 'nutrition',
                'description' => 'Bioavailable formulations engineered to restore mitochondrial function and optimize cellular health from within.',
                'is_active' => true,
            ],
            [
                'name' => 'Derma',
                'slug' => 'derma',
                'description' => 'Advanced dermal matrix protocols targeting visible signs of aging through precision topical applications.',
                'is_active' => true,
            ]
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
