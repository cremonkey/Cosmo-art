<?php

namespace Tests\Feature;

use App\Models\About;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $category = Category::query()->create([
            'name' => 'Nutrition',
            'slug' => 'nutrition',
            'is_active' => true,
        ]);

        Product::query()->create([
            'category_id' => $category->id,
            'title' => 'NAD+ Therapy',
            'slug' => 'nad-therapy',
            'short_description' => 'Short description',
            'description' => 'Long description',
            'is_active' => true,
            'is_featured' => true,
        ]);

        About::query()->create([
            'hero_title' => 'Where Science Meets Art',
            'is_visible' => true,
            'banner_title' => 'Our Therapies',
            'banner_description' => 'Description',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
