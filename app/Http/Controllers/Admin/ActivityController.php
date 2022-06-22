<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ActivityRepo;
use App\Http\Requests\ActivityRequest;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    private ActivityRepo $activityRepo;
    public function __construct(ActivityRepo $activityRepo)
    {
        $this->activityRepo = $activityRepo;
    }

    public function index()
    {
        $activities = $this->activityRepo->paginate(10);
        return view('admin.activities.index', compact('activities'));
    }

    public function create()
    {
        $data = $this->activityRepo->getCreatePageData();
        return view('admin.activities.create', $data);
    }

    public function store(ActivityRequest $request)
    {
        try {
            $this->activityRepo->store($request->all());
            return redirect()->route('admin.activities.index')->with(['success' => __('Project assigned successfully!')]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit(Activity $activity)
    {
        $data = $this->activityRepo->getCreatePageData();
        $data['activity'] = $activity;
        return view('admin.activities.edit', $data);
    }

    public function update(ActivityRequest $request, Activity $activity)
    {
        try {
            $this->activityRepo->update($request->all(), $activity);
            return redirect()->route('admin.activities.index')->with(['success' => __('Activity info updated successfully!')]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function stopActivity(Request $request, Activity $activity)
    {
        try {
            $this->activityRepo->stopActivity($activity);
            return redirect()->route('admin.activities.index')->with(['success' => __('Activity stopped successfully!')]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
