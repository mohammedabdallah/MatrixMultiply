<?php


namespace App\Services;


use App\Models\User;

class UserService
{
    public function createUser($input)
    {
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        return ['token' => $user->createToken('authToken')->accessToken, 'user' => $user];
    }
}
