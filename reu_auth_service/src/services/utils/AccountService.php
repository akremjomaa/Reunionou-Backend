<?php

namespace auth\services\utils;

use \MongoDB\BSON\ObjectId;
use \auth\utils\MongoClient;

final class AccountService {

    public static function getUserByUsername(string $username): ?\MongoDB\Model\BSONDocument {
        $collection = (new MongoClient())->getCollection('User');
        $cursor = $collection->findOne([ 'email' => $username ]);
        return $cursor ?? null;
    }
    
    public static function getUserById(string $id, array $projection = []): ?\MongoDB\Model\BSONDocument {
        $collection = (new MongoClient())->getCollection('User');
        $cursor = $collection->findOne([ 'id' => $id ]);
        return $cursor ?? null;
    }

    public static function updateRefreshToken(string $id, string $refreshToken): void {
        $collection = (new MongoClient())->getCollection('User');
        $collection->updateOne(
            [ 'id' => new $id ],
            [ '$set' => [ 'refresh_token' => $refreshToken ]]
        );
    }

}
