<?php

namespace Tests\Feature;

use App\Models\About;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductAndAdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_products_can_be_filtered_with_standard_category_query_param(): void
    {
        $this->createAbout();

        $nutrition = $this->createCategory('Nutrition', 'nutrition');
        $derma = $this->createCategory('Derma', 'derma');

        $nutritionProduct = $this->createProduct($nutrition, [
            'title' => 'Nutrition Product',
            'slug' => 'nutrition-product',
        ]);

        $this->createProduct($derma, [
            'title' => 'Derma Product',
            'slug' => 'derma-product',
        ]);

        $response = $this->get('/products?category=nutrition');

        $response->assertOk();
        $response->assertSee($nutritionProduct->title);
        $response->assertDontSee('Derma Product');
    }

    public function test_legacy_malformed_category_query_param_is_still_supported(): void
    {
        $this->createAbout();

        $nutrition = $this->createCategory('Nutrition', 'nutrition');
        $this->createProduct($nutrition, [
            'title' => 'Legacy Link Product',
            'slug' => 'legacy-link-product',
        ]);

        $response = $this->get('/products?category?nutrition');

        $response->assertOk();
        $response->assertSee('Legacy Link Product');
    }

    public function test_inactive_product_is_not_publicly_accessible_by_slug(): void
    {
        $category = $this->createCategory('Nutrition', 'nutrition');
        $product = $this->createProduct($category, [
            'slug' => 'inactive-product',
            'is_active' => false,
        ]);

        $response = $this->get('/products/'.$product->slug);

        $response->assertNotFound();
    }

    public function test_non_admin_user_cannot_access_admin_panel(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertForbidden();
    }

    public function test_super_admin_can_access_admin_panel(): void
    {
        $user = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertOk();
    }

    private function createAbout(): About
    {
        return About::query()->create([
            'hero_title' => 'Hero title',
            'hero_text' => 'Hero text',
            'is_visible' => true,
            'banner_title' => 'Banner title',
            'banner_description' => 'Banner description',
            'disclaimer_text' => 'Disclaimer',
        ]);
    }

    private function createCategory(string $name, string $slug): Category
    {
        return Category::query()->create([
            'name' => $name,
            'slug' => $slug,
            'description' => 'Category description',
            'is_active' => true,
            'sort_order' => 1,
        ]);
    }

    private function createProduct(Category $category, array $overrides = []): Product
    {
        return Product::query()->create(array_merge([
            'category_id' => $category->id,
            'title' => 'Product title',
            'slug' => 'product-title-'.uniqid(),
            'short_description' => 'Short description',
            'description' => '<p>Safe description</p>',
            'clinical_focus' => 'Clinical focus',
            'is_featured' => true,
            'is_active' => true,
        ], $overrides));
    }
}

