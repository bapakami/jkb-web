<?php

namespace App\Http\Controllers;

use App\Models\Branch;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::query()->active()->get();

        return view('pages.branches.index', compact('branches'));
    }

    public function show(Branch $branch)
    {
        abort_unless($branch->is_active, 404);

        $otherBranches = Branch::query()->active()
            ->whereKeyNot($branch->getKey())
            ->get();

        return view('pages.branches.show', compact('branch', 'otherBranches'));
    }
}