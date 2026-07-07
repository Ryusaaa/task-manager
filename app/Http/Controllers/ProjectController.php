<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ProjectController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            Project::orderBy('name')->get()
        );
    }

    public function store(StoreProjectRequest $request): RedirectResponse
    {
        Project::create($request->validated());

        return redirect()
            ->route('home')
            ->with('status', 'Project created.');
    }
}