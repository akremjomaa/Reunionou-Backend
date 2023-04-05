<?php

namespace events\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model {

    protected $table = 'user';
    protected  $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string';


    public function events() : HasMany
    {
        return $this->hasMany(Event::class, 'id', 'id');
    }
    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class, 'id', 'id');
    }

    public function invitations() : HasMany
    {
        return $this->hasMany(Invitation::class, 'id', 'id');
    }
}