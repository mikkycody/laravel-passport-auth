<?php

namespace App\Queries\User;

use App\Models\User;

class UserQueries
{
    public static function findUserByEmailOrPhoneNumber($emailOrPhoneNumber)
    {
        return User::where('email', $emailOrPhoneNumber)
            ->orWhere('phone_number', $emailOrPhoneNumber)
            ->first();
    }
}
