<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private \App\Http\Repositories\UserRepo $userRepo;
    public function __construct(\App\Http\Repositories\UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $users = $this->userRepo->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UserRequest $request)
    {
        try {
            $this->userRepo->store($request->all());
            return redirect()->route('admin.users.index')->with([
                'success' => 'User created successfully!'
            ]);
        } catch (\Exception $e) {
            redirect()->back()->withErrors([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }


    public function update(UserRequest $request, User $user)
    {
        try {
            $this->userRepo->update($request->all(), $user);
            return redirect()->route('admin.users.index')->with([
                'success' => 'User info updated successfully!'
            ]);
        } catch (\Exception $e) {
            redirect()->back()->withErrors([
                'error' => $e->getMessage()
            ]);
        }
    }
}
