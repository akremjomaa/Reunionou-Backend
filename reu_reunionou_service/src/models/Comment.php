<?php
namespace events\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends  Model{

    protected $table = 'comment';
    protected  $primaryKey = 'id';
    public $timestamps = false;

    public function commentator(): BelongsTo
    {
        return $this->belongsTo('events\models\User', 'invited_id');
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo('events\models\Event', 'event_id');
    }
}