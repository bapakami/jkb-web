<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Career;
use App\Models\News;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Project;
use App\Models\TahukahAnda;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = ['/' => '1.0', '/tentang-kami' => '0.9', '/produk' => '0.9', '/proyek' => '0.8', '/berita' => '0.7', '/karir' => '0.6', '/kontak' => '0.9', '/cabang' => '0.8', '/tahukah-anda' => '0.6'];

        $categories = ProductCategory::query()->active()->get();
        $products = Product::query()->active()->with('category')->get();
        $projects = Project::query()->active()->get();
        $news = News::query()->active()->get();
        $careers = Career::query()->open()->get();
        $branches = Branch::query()->active()->get();
        $tahukahAnda = TahukahAnda::query()->active()->get();

        return response()
            ->view('sitemap', compact(
                'urls', 'categories', 'products', 'projects',
                'news', 'careers', 'branches', 'tahukahAnda'
            ))
            ->header('Content-Type', 'application/xml');
    }
}