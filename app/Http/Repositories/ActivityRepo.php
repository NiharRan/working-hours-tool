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

    public function all()
    {
        return $this->activity->query()->with([
            'user', 'project'
        ])->orderBy('status', 'DESC')->orderBy('id', 'DESC');
    }

    public function getCreatePageData()
    {
        $data = [];
        $data['users'] = (new UserRepo)->all()->where('status', 1)->get();
        $data['projects'] = (new ProjectRepo)->all()->where('status', 1)->get();

        return $data;
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
                $this->stopActivity($running);
            }
            $activity = $this->activity->create([
                'user_id' => $data['user_id'],
                'project_id' => $data['project_id'],
                'start_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'status' => 1
            ]);
            DB::commit();

            return $activity;
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
            $activity->update([
                'user_id' => $data['user_id'],
                'project_id' => $data['project_id'],
            ]);
            DB::commit();

            return $activity;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * @throws \Exception
     */
    public function stopActivity(Activity $activity)
    {
        DB::beginTransaction();

        try {
            $end_date = date('Y-m-d H:i:s');
            $total_hours = ActivityService::calculateTotalHours($activity, $end_date);
            $activity = $activity->update([
                'end_at' => $end_date,
                'total_hours' => $total_hours,
                'status' => 2
            ]);
            DB::commit();

            return $activity;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
