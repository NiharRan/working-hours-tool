<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ActivityRepo;
use App\Http\Requests\ActivityRequest;
use App\Http\Services\Export\ActivityExporter;
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
        $data = $this->activityRepo->getIndexPageData();
        return view('admin.activities.index', $data);
    }

    public function create()
    {
        $data = $this->activityRepo->getCreatePageData();
        return view('admin.activities.create', $data);
    }

    public function store(ActivityRequest $request)
    {
        $result = $this->activityRepo->store($request->all());
        if ($result instanceof Activity) {
            return redirect()->route('admin.activities.index')->with([
                'success' => __('Project assigned successfully!')
            ]);
        }
        return redirect()->back()->with(['error' => $result]);
    }

    public function edit(Activity $activity)
    {
        $data = $this->activityRepo->getCreatePageData();
        $data['activity'] = $activity;
        return view('admin.activities.edit', $data);
    }

    public function update(ActivityRequest $request, Activity $activity)
    {
        $result = $this->activityRepo->update($request->all(), $activity);
        if ($result instanceof Activity) {
            return redirect()->route('admin.activities.index')->with([
                'success' => __('Activity info updated successfully!')
            ]);
        }
        return redirect()->back()->with(['error' => $result]);
    }


    public function stopActivity(Request $request, Activity $activity)
    {
        $result = $this->activityRepo->stopActivity($activity);
        if ($result instanceof Activity) {
            return redirect()->route('admin.activities.index')->with([
                'success' => __('Activity stopped successfully!')
            ]);
        }
        return redirect()->back()->with(['error' => $result]);
    }

    public function export(Request $request, $type)
    {
        $data = $this->activityRepo->all()->get();
        (new ActivityExporter())->downloadData($data);
    }
}
