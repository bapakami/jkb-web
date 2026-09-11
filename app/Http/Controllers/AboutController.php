<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;

class AboutController extends Controller
{
    public function index()
    {
        $yearsInBusiness = now()->year - 1980;
        $clients = Client::query()->active()->get();
        $projectCount = Project::query()->active()->count();
        $projectCategories = Project::query()->active()
            ->select('category')
            ->selectRaw('count(*) as total')
            ->groupBy('category')
            ->orderByDesc('total')
            ->get();

        return view('pages.about', compact(
            'yearsInBusiness', 'clients', 'projectCount', 'projectCategories'
        ));
    }
}