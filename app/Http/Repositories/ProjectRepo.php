<?php

namespace App\Http\Repositories;

use App\Models\Project;
use App\Traits\RepositoryTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProjectRepo
{
    use RepositoryTrait;

    private Project $project;
    public function __construct()
    {
        $this->project = new Project;
    }


    public function all(): Builder
    {
        return Project::query()->orderBy('status', 'DESC')->orderBy('name');
    }

    /**
     * @throws \Exception
     */
    public function store($data)
    {
        DB::beginTransaction();
        $message = '';
        $project = null;
        try {
            $project = Project::create([
                'name' => $data['name'],
                'status' => 1
             ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
        }
        return $project ?: $message;
    }


    /**
     * @throws \Exception
     */
    public function update($data, Project $project)
    {
        DB::beginTransaction();
        $message = '';
        try {
            $data = Arr::only($data, ['name', 'status']);
            $project = $project->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
        }
        return $project ?: $message;
    }
}
