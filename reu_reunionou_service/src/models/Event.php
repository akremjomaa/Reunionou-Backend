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
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany('events\models\Comment', 'event_id');
    }
    public function invitations(): HasMany
    {
        return $this->hasMany('events\models\Invitation', 'event_id');
    }
}