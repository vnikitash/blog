<?php
namespace App\Services;

set_time_limit(7200); // There will be HUGE amount of mysql inserts

use App\Models\User;
use App\Models\UserToUser;

class TestDataService
{
    public function generateRandomUsersAmount(int $amount): bool
    {
        User::query()->truncate();
        UserToUser::query()->truncate();

        try {
            $users = [];

            $colorsCount = count(User::PRIMARY_COLORS) - 1;

            for ($i = 0; $i < $amount; $i++) {

                $users[] = [
                    'first_name' => 'First Name ' . $i,
                    'last_name' => 'Last Name ' . $i,
                    'color' => User::PRIMARY_COLORS[rand(0, $colorsCount - 1)],
                ];

                //Lets make it in chunks. Max chunk size = 10 000
                if (($i % 10000) === 0 && $i !== 0) {
                    User::insert($users);
                    $users = [];
                }
            }

            //If we had 11 330 users first chunk was inserted when we had 10 000 users. but 1 330 still not added
            if ($users) {
                User::insert($users);
            }

            $userIds = User::query()->pluck('id')->toArray();

            $this->generateFriends($userIds);
            return true;

        } catch (\Exception $e)
        {
            return false;
        }

    }

    private function generateFriends(array $existingUserIds)
    {
        $countOfExistingUsers = count($existingUserIds);

        //IF we have only 1 user in our DB, no friends could exist
        $maxFriendsCount = ($countOfExistingUsers > 50) ? 50 : $countOfExistingUsers - 1;

        if ($maxFriendsCount < 1) {
            return;
        }

        $friends = [];

        foreach ($existingUserIds as $index => $userId) {

            $ignoredUsers = [$index => $userId];
            unset($existingUserIds[$index]);

            $friendsCount = rand(0, $maxFriendsCount);

            //0 friends = no need to generate
            if (!$friendsCount) {
                continue;
            }

            for ($i = 0; $i < $friendsCount; $i++) {
                //Get random key
                $friendIdIndex = array_rand($existingUserIds);

                $ignoredUsers[$friendIdIndex] = $friendId = $existingUserIds[$friendIdIndex];
                //Remove this user id, as 1 user could not have 2 friends with the same userId
                unset($existingUserIds[$friendIdIndex]);

                $friends[] = ['user_id' => $userId, 'friend_id' => $friendId];

                if (count($friends) === 10000) {
                    UserToUser::insert($friends);
                    $friends = [];
                }
            }

            //Restore array how it was before generated for user
            foreach ($ignoredUsers as $key => $value) {
                $existingUserIds[$key] = $value;
            }
        }

        if ($friends) {
            UserToUser::insert($friends);
        }
    }
}