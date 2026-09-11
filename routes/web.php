<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\TahukahAndaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about');

Route::get('/produk', [ProductController::class, 'index'])->name('products.index');
Route::get('/produk/{category:slug}', [ProductController::class, 'category'])->name('products.category');
Route::get('/produk/{category:slug}/{product:slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/proyek', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/proyek/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
Route::get('/berita/{news:slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/karir', [CareerController::class, 'index'])->name('careers.index');
Route::get('/karir/{career:slug}', [CareerController::class, 'show'])->name('careers.show');

Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'submit'])->name('contact.submit')->middleware('throttle:5,1');

Route::get('/cabang', [BranchController::class, 'index'])->name('branches.index');
Route::get('/cabang/{branch:slug}', [BranchController::class, 'show'])->name('branches.show');

Route::get('/tahukah-anda', [TahukahAndaController::class, 'index'])->name('tahukah-anda.index');
Route::get('/tahukah-anda/{tahukahAnda:slug}', [TahukahAndaController::class, 'show'])->name('tahukah-anda.show');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');