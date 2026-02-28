<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $about = About::query()->latest()->first();

        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->limit(2)
            ->get();

        $featuredProducts = Product::query()
            ->with('category')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->limit(4)
            ->get();

        if ($featuredProducts->isEmpty()) {
            $featuredProducts = Product::query()
                ->with('category')
                ->where('is_active', true)
                ->latest()
                ->limit(4)
                ->get();
        }

        return view('welcome', compact('about', 'categories', 'featuredProducts'));
    }
}
