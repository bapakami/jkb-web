<?php

namespace App\Http\Controllers;

use App\Models\Career;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::query()->open()->latest()->get();

        return view('pages.careers.index', compact('careers'));
    }

    public function show(Career $career)
    {
        $open = $career->is_active
            && ($career->application_deadline === null || $career->application_deadline->gte(now()->toDateString()));

        abort_unless($open, 404);

        $otherCareers = Career::query()->open()
            ->whereKeyNot($career->getKey())
            ->latest()
            ->take(3)
            ->get();

        return view('pages.careers.show', compact('career', 'otherCareers'));
    }
}