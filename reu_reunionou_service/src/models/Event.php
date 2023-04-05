<?php
namespace events\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends  Model{

    protected $table = 'event';
    protected  $primaryKey = 'id';
    public $timestamps = false;

   // protected $dates = ['date'];
    public function user(): BelongsTo
    {
        return $this->belongsTo('events\models\User', 'id');
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