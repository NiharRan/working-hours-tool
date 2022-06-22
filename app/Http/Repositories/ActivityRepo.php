<?php

namespace App\Http\Repositories;

use App\Http\Services\ActivityService;
use App\Models\Activity;
use App\Models\Project;
use App\Models\User;
use App\Traits\RepositoryTrait;
use Illuminate\Support\Carbon;
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
        $query = $this->activity->query()->with([
            'user', 'project'
        ]);

        $user_id = request()->get('user_id', null);
        if ($user_id) {
            $query = $query->where('user_id', $user_id);
        }

        $project_id = request()->get('project_id', null);
        if ($project_id) {
            $query = $query->where('project_id', $project_id);
        }

        $start_date = request()->get('start_date', null);
        if ($start_date) {
            $start_date = date('Y-m-d 00:00:00', strtotime($start_date));
            $query = $query->where('start_at', '>=', $start_date);
        }

        $end_date = request()->get('end_date', null);
        if ($end_date) {
            $end_date = date('Y-m-d 23:59:59', strtotime($end_date));
            $query = $query->where('end_at', '<=', $end_date);
        }

        return $query->orderBy('status', 'DESC')->orderBy('id', 'DESC');
    }

    public function getIndexPageData()
    {
        $per_page = request()->get('per_page', 20);
        $data = [];
        $data['users'] = (new UserRepo)->all()->where('status', 1)->get();
        $data['projects'] = (new ProjectRepo)->all()->where('status', 1)->get();
        $data['activities'] = $this->paginate($per_page);

        return $data;
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
        $message = '';
        $activity = null;
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
        } catch (\Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
        }
        return $activity ?: $message;
    }

    /**
     * @throws \Exception
     */
    public function update($data, Activity $activity)
    {
        DB::beginTransaction();
        $message = '';
        try {
            $activity = $activity->update([
                'user_id' => $data['user_id'],
                'project_id' => $data['project_id'],
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
        }
        return $activity ?: $message;
    }

    /**
     * @throws \Exception
     */
    public function stopActivity(Activity $activity)
    {
        DB::beginTransaction();
        $message = '';
        try {
            $end_date = date('Y-m-d H:i:s');
            $total_hours = ActivityService::calculateTotalHours($activity, $end_date);
            $activity = $activity->update([
                'end_at' => $end_date,
                'total_hours' => $total_hours,
                'status' => 2
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
        }

        return $activity ?: $message;
    }
}
