<?php

namespace auth\services\utils;
use auth\models\User;


final class AccountService {

    public static function getUserByUsername(string $username): ?User {
        return User::select('id', 'name', 'firstname', 'email', 'password', 'status', 'refresh_token')
                ->where('email', '=', $username)
                ->firstOrFail();

    }
    
    public static function getUserById(string $id): ?User {
        return User::select('id', 'name', 'firstname', 'email', 'password', 'status', 'refresh_token')
                ->where('id', '=', $id)
                ->firstOrFail();
    }
    
    public static function updateRefreshToken(string $id, string $refreshToken): void {
        User::where('id', '=', $id)
        ->update(['refresh_token' => $refreshToken]);
    }
    

}
