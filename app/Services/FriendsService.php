<?php

namespace App\Services;


use App\Models\User;
use App\Models\UserToUser;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FriendsService
{
    public function getFriendsOfUserByUserId(int $userId, int $page = 1, int $perPage = 10): LengthAwarePaginator
    {
        return User::query()
            ->whereIn(
                'id',
                UserToUser::query()
                    ->where('user_id', $userId)
                    ->pluck('friend_id')
                    ->toArray()
            )->paginate($perPage, ['*'], 'page', $page);
    }
}