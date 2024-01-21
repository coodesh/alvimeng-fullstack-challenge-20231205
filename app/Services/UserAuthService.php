<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAuthService
{
    public function createUser(array $userData)
    {
        return User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
        ]);
    }

    public function loginUser(array $loginData)
    {
        $user = User::where('email', $loginData['email'])->first();

        if (!$user || !Hash::check($loginData['password'], $user->password)) {
            return null;
        }

        return $user->createToken($user->name . '-AuthToken')->plainTextToken;
    }
    
    public function logoutUser($user)
    {
        $user->tokens()->delete();
    }
}