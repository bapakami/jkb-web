<?php

namespace App\Http\Controllers;

use App\Models\TahukahAnda;

class TahukahAndaController extends Controller
{
    public function index()
    {
        $items = TahukahAnda::query()->active()->latest('published_at')->paginate(9);

        return view('pages.tahukah-anda.index', compact('items'));
    }

    public function show(TahukahAnda $tahukahAnda)
    {
        abort_unless($tahukahAnda->is_active && $tahukahAnda->published_at?->lte(now()), 404);

        $related = TahukahAnda::query()->active()
            ->whereKeyNot($tahukahAnda->getKey())
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.tahukah-anda.show', compact('tahukahAnda', 'related'));
    }
}