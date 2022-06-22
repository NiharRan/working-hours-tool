<?php

namespace App\Http\Services;

use App\Models\Activity;
use Illuminate\Support\Carbon;

class ActivityService
{
    public static function calculateTotalHours(Activity $activity, $date): float
    {
        $start_at = Carbon::createFromDate($activity->start_at);
        $end_at = Carbon::createFromDate($date);
        $minutes = $start_at->diffInMinutes($end_at);
        return ($minutes / 60);
    }
}
