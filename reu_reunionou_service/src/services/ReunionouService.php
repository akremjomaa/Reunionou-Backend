<?php

namespace events\services;

use events\models\User;

final class ReunionouService {
    public static function getUsers() {
        $query = User::select('id', 'firstname', 'name as lastname', 'email', 'password', 'status');
        return $query->get()->toArray();
    }

    public static function CreateUser($data) {
        $query = new User;
        $query->name = $data['name'];
        $query->firstname = $data['firstname'];
        $query->email = $data['email'];
        $query->password = $data['password'];
        $query->save();
    }
}