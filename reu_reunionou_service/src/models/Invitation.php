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
        return $this->belongsTo(User::class, 'user_id');
    }
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}