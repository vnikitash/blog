<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserService
{
    public function getUserList(int $page = 1, int $perPage = 10): LengthAwarePaginator
    {
        return User::query()->with('friends')->paginate($perPage, ['*'], 'page', $page);
    }
}