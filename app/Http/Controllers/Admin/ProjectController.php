<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ProjectRepo;
use App\Http\Requests\Admin\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private ProjectRepo $projectRepo;
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
        $result = $this->projectRepo->store($request->all());
        if ($result instanceof Project) {
            return redirect()->route('admin.projects.index')->with([
                'success' => 'Project created successfully!'
            ]);
        }
        return redirect()->back()->with(['error' => $result]);
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }


    public function update(ProjectRequest $request, Project $project)
    {
        $result = $this->projectRepo->update($request->all(), $project);
        if ($result instanceof Project) {
            return redirect()->route('admin.projects.index')->with([
                'success' => 'Project info updated successfully!'
            ]);
        }
        return redirect()->back()->with(['error' => $result]);
    }
}
