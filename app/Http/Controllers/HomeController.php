<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Client;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Project;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::query()->active()->withCount('activeProducts')->get();
        $featuredProducts = Product::query()->active()->featured()
            ->with('category')->orderBy('sort_order')->take(6)->get();
        $featuredProjects = Project::query()->active()->featured()
            ->orderBy('sort_order')->take(3)->get();
        $branches = Branch::query()->active()->get();
        $testimonials = Testimonial::query()->active()->get();
        $clients = Client::query()->active()->get();

        return view('home', compact(
            'categories', 'featuredProducts', 'featuredProjects',
            'branches', 'testimonials', 'clients'
        ));
    }
}