<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProjectController extends Controller
{
   
    public function index(): View
    {
        $projects = Project::latest()->get();

        return view('projects.index', compact('projects'));
    }

    
    public function create(): View
    {
        return view('projects.create');
    }

    
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'       => 'required|string|min:5|max:255',
            'description' => 'required|string',
            'status'      => 'required|in:Pending,In Progress,Completed',
            'due_date'    => 'nullable|date',
        ]);

        Project::create($validated);

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully!');
    }

   
    public function edit(Project $project): View
    {
        return view('projects.edit', compact('project'));
    }

    
    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'title'       => 'required|string|min:5|max:255',
            'description' => 'required|string',
            'status'      => 'required|in:Pending,In Progress,Completed',
            'due_date'    => 'nullable|date',
        ]);

        $project->update($validated);

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully!');
    }

   
    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully!');
    }
}