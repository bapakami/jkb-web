<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::query()->active()
            ->with('activeProducts')
            ->withCount('activeProducts')
            ->orderBy('sort_order')
            ->get();

        $productCount = Product::query()->active()->count();

        return view('pages.products.index', compact('categories', 'productCount'));
    }

    public function category(ProductCategory $category)
    {
        abort_unless($category->is_active, 404);

        $products = $category->activeProducts()->with('category')->get();
        $otherCategories = ProductCategory::query()->active()
            ->whereKeyNot($category->getKey())
            ->orderBy('sort_order')
            ->get();

        return view('pages.products.category', compact('category', 'products', 'otherCategories'));
    }

    public function show(ProductCategory $category, Product $product)
    {
        abort_unless($category->is_active && $product->is_active && $product->category_id === $category->id, 404);

        $related = Product::query()->active()
            ->with('category')
            ->where('category_id', $category->id)
            ->whereKeyNot($product->getKey())
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        return view('pages.products.show', compact('category', 'product', 'related'));
    }
}