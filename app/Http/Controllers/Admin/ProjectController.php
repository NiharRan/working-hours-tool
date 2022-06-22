<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ProjectRepo;
use App\Http\Requests\Admin\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private \App\Http\Repositories\ProjectRepo $projectRepo;
    public function __construct(ProjectRepo $projectRepo)
    {
        $this->projectRepo = $projectRepo;
    }

    public function index()
    {
        $projects = $this->projectRepo->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(ProjectRequest $request)
    {
        try {
            $this->projectRepo->store($request->all());
            return redirect()->route('admin.projects.index')->with([
                'success' => 'Project created successfully!'
            ]);
        } catch (\Exception $e) {
            redirect()->back()->withErrors([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }


    public function update(ProjectRequest $request, Project $project)
    {
        try {
            $this->projectRepo->update($request->all(), $project);
            return redirect()->route('admin.projects.index')->with([
                'success' => 'Project info updated successfully!'
            ]);
        } catch (\Exception $e) {
            redirect()->back()->withErrors([
                'error' => $e->getMessage()
            ]);
        }
    }
}
