<?php

namespace App\Http\Repositories;

use App\Http\Services\ActivityService;
use App\Models\Activity;
use App\Models\Project;
use App\Models\User;
use App\Traits\RepositoryTrait;
use Illuminate\Support\Facades\DB;

class ActivityRepo
{
    use RepositoryTrait;

    private User $user;
    private Project $project;
    private Activity $activity;
    public function __construct()
    {
        $this->user = new User;
        $this->project = new Project;
        $this->activity = new Activity;
    }


    public function getRunningActivity($user_id): Activity|null
    {
        return $this->activity->with(['user', 'project'])->where([
            'user_id' => $user_id,
            'status' => 1
        ])->first();
    }


    /**
     * @throws \Exception
     */
    public function store($data)
    {
        DB::beginTransaction();

        try {
            $running = $this->getRunningActivity($data['user_id']);
            if ($running) {
                $this->update([], $running);
            }
            $project = $this->activity->create([
                'user_id' => $data['user_id'],
                'project_id' => $data['project_id'],
                'start_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'status' => 1
            ]);
            DB::commit();

            return $project;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * @throws \Exception
     */
    public function update($data, Activity $activity)
    {
        DB::beginTransaction();

        try {
            $end_date = date('Y-m-d H:i:s');
            $total_hours = ActivityService::calculateTotalHours($activity, $end_date);
            $project = $activity->update([
                'end_at' => $end_date,
                'total_hours' => $total_hours,
                'status' => 2
            ]);
            DB::commit();

            return $project;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
