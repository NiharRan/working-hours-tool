<?php

namespace App\Http\Responses;

use App\Http\Repositories\ActivityRepo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Contracts\LogoutResponse as ContractsLogoutResponse;

class LogoutResponse implements ContractsLogoutResponse
{
    public function toResponse($request)
    {
        Session::remove('local');
        $activityRepo = new ActivityRepo();
        $activity = $activityRepo->getRunningActivity(Auth::id());
        if ($activity) {
            $activityRepo->stopActivity($activity);
        }
        return redirect()->intended(config('login'));
    }
}
