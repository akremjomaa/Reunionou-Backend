<?php
namespace events\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invitation extends  Model{

    protected $table = 'invitation';
    protected  $primaryKey = 'id';
    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo('events\models\User', 'user_id');
    }
    public function event(): BelongsTo
    {
        return $this->belongsTo('events\models\Event', 'event_id');
    }
}