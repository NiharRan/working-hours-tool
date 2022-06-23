<?php

namespace App\Http\Repositories;

use App\Models\User;
use App\Traits\RepositoryTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepo
{
    use RepositoryTrait;

    private User $user;
    public function __construct()
    {
        $this->user = new User;
    }


    public function all(): Builder
    {
        return User::query()->orderBy('status', 'DESC')->orderBy('name');
    }

    /**
     * @throws \Exception
     */
    public function store($data): User|string
    {
        DB::beginTransaction();
        $message = '';
        $user = null;
        try {
            $data = Arr::only($data, ['name', 'username', 'email', 'role', 'password']);
            $data['password'] = Hash::make($data['password']);
            $data['status'] = 1;
            $user = User::create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
        }

        return $user ?: $message;
    }


    /**
     * @throws \Exception
     */
    public function update($data, User $user): User|string
    {
        DB::beginTransaction();
        $message = '';
        try {
            $data = Arr::only($data, ['name', 'username', 'email', 'role', 'status']);
            $user->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
        }

        return $user ?: $message;
    }
}
