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

    public function index()
    {
        $data = $this->activityRepo->getIndexPageData();
        return view('activities', $data);
    }

    public function store(ActivityRequest $request)
    {
        $result = $this->activityRepo->store($request->all());
        if ($result instanceof Activity) {
            return redirect()->route('dashboard')->with([
                'success' => __('Project assigned successfully!')
            ]);
        }
        return redirect()->back()->with(['error' => $result]);
    }

    public function update(ActivityRequest $request, Activity $activity)
    {
        $result = $this->activityRepo->stopActivity($activity);
        if ($result instanceof Activity) {
            return redirect()->route('dashboard')->with([
                'success' => __('Work stopped successfully!')
            ]);
        }
        return redirect()->back()->with(['error' => $result]);
    }
}
