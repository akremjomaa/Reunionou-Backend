<?php

namespace events\services;

use events\models\User;

final class ReunionouService {
    public static function getUsers() {
        $query = User::select('id', 'firstname', 'name as lastname', 'email', 'password', 'status');
        return $query->get()->toArray();
    }
}