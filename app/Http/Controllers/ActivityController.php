<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ActivityRepo;
use App\Http\Requests\ActivityRequest;
use App\Models\Activity;

class ActivityController extends Controller
{
    private ActivityRepo $activityRepo;
    public function __construct(ActivityRepo $activityRepo)
    {
        $this->activityRepo = $activityRepo;
    }

    public function store(ActivityRequest $request)
    {
        try {
            $this->activityRepo->store($request->all());
            return redirect()->route('dashboard')->with(['success' => __('Project assigned successfully!')]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(ActivityRequest $request, Activity $activity)
    {
        try {
            $this->activityRepo->stopActivity($activity);
            return redirect()->route('dashboard')->with(['success' => __('Work stopped successfully!')]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
