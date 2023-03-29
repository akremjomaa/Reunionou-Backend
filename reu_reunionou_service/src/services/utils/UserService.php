<?php

namespace events\services\utils;

use events\models\User;

final class UserService {

    //get list of users
    public static function getUsers() {
        $query = User::select('id', 'firstname', 'name as lastname', 'email', 'password', 'status');
        return $query->get()->toArray();
    }

    // get user by id
    public static function getUserById(int $id) {
        $query = User::select('id', 'firstname', 'name as lastname', 'email', 'password', 'status')->where('id', '=', $id);
        return $query->get()->toArray();
    }

    // create user
    public static function createUser($data) {
        $query = new User;
        $query->name = $data['name'];
        $query->firstname = $data['firstname'];
        $query->email = $data['email'];
        $query->password = $data['password'];

        // status can be nullable

        if (isset($data['status'])) {
            $query->status = $data['status'];
        }
        $query->save();

        return true;
    }

    // update user by id
    public static function ModifyUser(int $id, array $data) {
        try {
            $query = User::find($id);
            $query->name = filter_var($data["name"], FILTER_SANITIZE_SPECIAL_CHARS);
            $query->firstname = filter_var($data["firstname"], FILTER_SANITIZE_SPECIAL_CHARS);
            $query->email = filter_var($data["email"], FILTER_SANITIZE_EMAIL);
            $query->password = filter_var($data["password"], FILTER_SANITIZE_SPECIAL_CHARS);

            return $query->save();
        } catch (\Throwable $ex) {
            throw $ex;
        }
    }

    // delete user by id
    public static function DeleteUser(int $id) {
        try {
            $query = User::find($id);
            return $query->delete();
        } catch (\Throwable $ex) {
            throw $ex;
        }
    }
}