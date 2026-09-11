<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $categories = ['Komersial & Perumahan', 'Industri', 'Infrastruktur'];

        $selectedCategory = request()->query('kategori');
        $query = Project::query()->active()->orderByDesc('created_at');

        if ($selectedCategory && in_array($selectedCategory, $categories, true)) {
            $query->where('category', $selectedCategory);
        }

        $projects = $query->paginate(9)->withQueryString();

        return view('pages.projects.index', compact('projects', 'categories', 'selectedCategory'));
    }

    public function show(Project $project)
    {
        abort_unless($project->is_active, 404);

        $otherProjects = Project::query()->active()
            ->whereKeyNot($project->getKey())
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        return view('pages.projects.show', compact('project', 'otherProjects'));
    }
}