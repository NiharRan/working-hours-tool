<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\UserRepo;
use App\Http\Requests\Admin\ResetPasswordRequest;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;

class PasswordResetController extends Controller
{
    private UserRepo $userRepo;
    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function edit(User $user)
    {
        return view('admin.users.password', compact('user'));
    }


    public function update(ResetPasswordRequest $request, User $user)
    {
        $result = $this->userRepo->updatePassword($request->all(), $user);
        if ($result instanceof User) {
            return redirect()->route('admin.users.index')->with([
                'success' => __('User password updated successfully!')
            ]);
        }
        return redirect()->back()->with(['error' => $result]);
    }
}
