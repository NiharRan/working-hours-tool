<?php

namespace App\Http\Repositories;

use App\Models\Project;
use App\Models\User;
use App\Traits\RepositoryTrait;
use Illuminate\Support\Facades\Auth;

class DashboardRepo
{
    use RepositoryTrait;

    private User $user;
    private Project $project;
    public function __construct()
    {
        $this->user = new User;
        $this->project = new Project;
    }


    public function indexPageData(): array
    {
        $data = [];

        $data['projects'] = $this->project->where([
            'status' => 1
        ])->orderBy('name')->get();

        $data['running'] = (new ActivityRepo)->getRunningActivity(Auth::id());
        return $data;
    }
}
