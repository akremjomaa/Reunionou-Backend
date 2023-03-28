<?php

namespace events\services\utils;



use events\models\Event;
use events\models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use events\errors\exceptions\EventExceptionNotFound;

final class EventService {

    public function getEvents(): Array
    {
        $query = Event::select('id', 'title as event_title', 'description as event_description', 'lieu as event_place','status as event_status','user_id as created_by')->get();

        try {
            return $query->toArray();
        }catch (ModelNotFoundException $e) {
            throw new \Exception("orders not found");
        }
    }
    public function getEventUser(string $id): array
    {
        $query = Event::select()->where('id', '=', $id);

        $user = User::select()->where('id', '=', $query->user_id)->get();
        return $user->firstOrFail()->toArray();
    }

    public function getEventById(string $id, ?array $embeds=null): array
    {
        $query = Event::select('id', 'title as event_title', 'description as event_description', 'lieu as event_place','status as event_status','user_id as created_by')->where('id', '=', $id);
        if ($embeds !== null){
            foreach ($embeds as $embed) {
                if ($embed === 'user'){
                    $query = $query->with('user');
                   // echo($query);
                } else if ($embed === 'invitations') {
                    $query = $query->with('invitations');
                }
                else if ($embed === 'comments'){
                    $query = $query->with('comments');
                }
            }

        }

        try {
            return $query->firstOrFail()->toArray();
        }catch (ModelNotFoundException $e) {
            throw new EventExceptionNotFound("order $id not found");
        }
    }




}
