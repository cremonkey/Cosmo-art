<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\About::query()->updateOrCreate(['id' => 1], [
            'hero_title' => "Where Science \nMeets Art.",
            'hero_text' => "We believe true luxury is longevity. Our approach to cellular regeneration is rooted in precise, methodical Swedish innovation, elevating restorative nutrition into an art form.",
            'philosophy_subtitle' => 'Swedish Innovation',
            'philosophy_title' => 'Cellular Regeneration',
            'philosophy_content' => "Our protocols are developed with a foundational understanding of the body's intrinsic healing capabilities. We utilize highly bioavailable nutrients to target mitochondrial decline.\n\nDrawing inspiration from Swedish minimalism, our therapies deliver exactly what the cell requires to repair epigenetic damage—nothing more, nothing less.",
            'science_title' => 'The Science of NAD+',
            'science_content' => 'Nicotinamide Adenine Dinucleotide is the cornerstone of cellular metabolism and the ultimate currency of energy and longevity.',
            'showcase_title' => 'Pioneering Solutions',
            'showcase_subtitle' => 'Our Focus',
            'is_visible' => true,
            'banner_title' => 'Advanced Therapies',
            'banner_description' => 'Discover our protocols designed for cellular regeneration and longevity.',
            'disclaimer_text' => 'Clinical protocols are subject to professional consultation.',
            'infographics' => [
                [
                    'title' => 'Cellular Energy',
                    'description' => 'NAD+ acts as a critical coenzyme in the mitochondria, facilitating the conversion of nutrients into ATP fuel.',
                    'icon' => 'heroicon-o-bolt',
                ],
                [
                    'title' => 'Anti-Aging Support',
                    'description' => 'Activates sirtuins, longevity proteins responsible for repairing DNA replication errors.',
                    'icon' => 'heroicon-o-clock',
                ],
                [
                    'title' => 'Cognitive Enhancement',
                    'description' => 'Promotes neurogenesis and protects against neurodegenerative stress, ensuring mental acuity.',
                    'icon' => 'heroicon-o-light-bulb',
                ],
                [
                    'title' => 'Skin Regeneration',
                    'description' => 'Restores structural integrity at the dermal matrix, delaying the visible signs of chronological aging.',
                    'icon' => 'heroicon-o-sparkles',
                ],
            ],
        ]);
    }
}
