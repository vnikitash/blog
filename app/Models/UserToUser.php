<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserToUser
 * @package App\Models
 * @property int $user_id
 * @property int $friend_id
 */

class UserToUser extends Model
{
    protected $table = 'users_to_users';
    public $timestamps = false;
}
