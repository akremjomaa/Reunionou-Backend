<?php
namespace events\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends  Model{

    protected $table = 'user';
    protected  $primaryKey = 'id';
    public $timestamps = false;


    public function events(): HasMany
    {
        return $this->hasMany('events\models\Event', 'id');
    }
    public function comments(): HasMany
    {
        return $this->hasMany('events\models\Comment', 'id');
    }

    public function invitations(): HasMany
    {
        return $this->hasMany('events\models\Invitation', 'id');
    }
}