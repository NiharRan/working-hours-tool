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

    public static function formatTotalHours($hours): float
    {
        $minutes = $hours * 60;
        $round_hours = floor($hours);
        $fraction = $minutes - (60 * $round_hours);
        $extra = 0;
        if ($fraction <= 15) {
            $extra = .25;
        } elseif ($fraction <= 30) {
            $extra = .5;
        } elseif ($fraction <= 45) {
            $extra = .75;
        } elseif ($fraction < 60) {
            $extra = 1;
        }
        return $round_hours + $extra;
    }
}
