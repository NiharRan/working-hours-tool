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
    public function store($data)
    {
        DB::beginTransaction();

        try {
            $data = Arr::only($data, ['name', 'username', 'email', 'role', 'password']);
            $data['password'] = Hash::make($data['password']);
            $data['status'] = 1;
            $user = User::create($data);
            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }


    /**
     * @throws \Exception
     */
    public function update($data, User $user)
    {
        DB::beginTransaction();

        try {
            $data = Arr::only($data, ['name', 'username', 'email', 'role', 'status']);
            $user = $user->update($data);
            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
}
