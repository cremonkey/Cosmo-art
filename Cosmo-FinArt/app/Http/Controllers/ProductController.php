<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categorySlug = $request->query('category');

        // Backward compatibility for legacy malformed URLs: /products?category?slug
        if (! $categorySlug) {
            foreach (array_keys($request->query()) as $key) {
                if (str_starts_with((string) $key, 'category?')) {
                    $categorySlug = trim(substr((string) $key, 9));
                    break;
                }
            }
        }

        $categorySlug = is_string($categorySlug) ? trim($categorySlug) : null;
        $categorySlug = $categorySlug !== '' ? $categorySlug : null;

        $query = Product::with(['category'])->where('is_active', true);
        $query->whereHas('category', fn ($q) => $q->where('is_active', true));

        if ($categorySlug) {
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug)
                    ->where('is_active', true);
            });
        }

        $products = $query->orderBy('title')->get();
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();
        $about = About::query()->latest()->first();

        return view('products.index', compact('products', 'categories', 'categorySlug', 'about'));
    }

    public function show($slug)
    {
        $product = Product::query()
            ->with(['category'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        
        return view('products.show', compact('product'));
    }
}
