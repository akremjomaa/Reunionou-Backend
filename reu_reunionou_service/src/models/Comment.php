<?php
namespace events\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends  Model{

    protected $table = 'comment';
    protected  $primaryKey = 'id';
    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo('events\models\User', 'id');
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo('events\models\Event', 'id');
    }
}