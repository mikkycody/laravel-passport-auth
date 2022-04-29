<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserActions
{
    public static function create(){
        return User::create([
            'name' => request()->name,
            'email' => request()->email,
            'phone_number' => request()->phone_number,
            'password' => Hash::make(request()->password),
        ]);
    }
}
