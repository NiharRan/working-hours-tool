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

        try {
            $project = Project::create([
                'name' => $data['name'],
                'status' => 1
             ]);
            DB::commit();

            return $project;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }


    /**
     * @throws \Exception
     */
    public function update($data, Project $project)
    {
        DB::beginTransaction();

        try {
            $data = Arr::only($data, ['name', 'status']);
            $project = $project->update($data);
            DB::commit();

            return $project;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
}
