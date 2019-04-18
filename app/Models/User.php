<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;

    public const PRIMARY_COLORS  = [
        '#C0392B',
        '#E74C3C',
        '#9B59B6',
        '#2980B9',
        '#16A085',
        '#F1C40F',
    ];

    public function friends()
    {
        return $this->belongsToMany(
            User::class,
            'users_to_users',
            'user_id',
            'friend_id',
            'id',
            'id');
    }
}
