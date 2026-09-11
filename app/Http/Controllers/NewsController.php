<?php

namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::query()->active()->latest('published_at')->paginate(9);

        return view('pages.news.index', compact('news'));
    }

    public function show(News $news)
    {
        abort_unless($news->is_active && $news->published_at?->lte(now()), 404);

        $news->increment('views');

        $related = News::query()->active()
            ->whereKeyNot($news->getKey())
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.news.show', compact('news', 'related'));
    }
}