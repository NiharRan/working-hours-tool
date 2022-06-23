<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\UserRepo;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserRepo $userRepo;
    public function __construct(UserRepo $userRepo)
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
        $result = $this->userRepo->store($request->all());
        if ($result instanceof User) {
            return redirect()->route('admin.users.index')->with([
                'success' => __('User created successfully!')
            ]);
        }
        return redirect()->back()->with(['error' => $result]);
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }


    public function update(UserRequest $request, User $user)
    {
        $result = $this->userRepo->update($request->all(), $user);
       if ($result instanceof User) {
           return redirect()->route('admin.users.index')->with([
               'success' => __('User info updated successfully!')
           ]);
       }
       return redirect()->back()->with(['error' => $result]);
    }
}
