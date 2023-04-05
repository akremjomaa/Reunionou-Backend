<?php

namespace events\services\utils;



use events\models\Comment;
use events\models\Event;
use events\models\Invitation;
use events\models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use events\errors\exceptions\EventExceptionNotFound;

final class EventService {


    // get all events
    public function getEvents(): Array
    {
        $query = Event::select('id', 'title as event_title', 'description as event_description', 'lieu as event_place','date as event_date','status as event_status','user_id as created_by')->get();

        try {
            return $query->toArray();
        }catch (ModelNotFoundException $e) {
            throw new \Exception("orders not found");
        }
    }

    // get user invited to this event

    public function getEventUser(string $id): array
    {
        $query = Event::select()->where('id', '=', $id)->get()->toArray();
         $userId = $query[0]['user_id'];

        $user = User::select()->where('id', '=', $userId)->get();
        return $user->firstOrFail()->toArray();
    }

    // get list of invitations related  to this event

    public function getEventInvitations(string $id): array
    {
        $invitations = Invitation::select('invitation.id','invitation.invitation_date','invitation.status','user.name as invited_name','user.firstname as invited_firstName','user.email as invited_email')->where('event_id', '=', $id)->join('user','invitation.invited_id','=','user.id')->get();

        return $invitations->toArray();
    }

    // get list of comments related  to this event

    public function getEventComments(string $id): array
    {
        $Comments = Comment::select('comment.id','comment.content','comment.user_name','user.name as invited_name','user.firstname as invited_firstName','user.email as invited_email')->where('event_id', '=', $id)->join('user','comment.invited_id','=','user.id')->get();

        return $Comments->toArray();
    }

    // get event by id with optional embeds for (user , invitations , comments)
    public function getEventById(string $id, ?array $embeds=null): array
    {
        $query = Event::select('id', 'title as event_title', 'description as event_description', 'lieu as event_place','date as event_date','status as event_status','user_id as created_by')->where('id', '=', $id);
        if ($embeds !== null){
            foreach ($embeds as $embed) {
                if ($embed === 'creator'){
                    $query = $query->with(['creator' => function($query){
                        $query->select('id','name','firstname','email');
                    }]);
                    // echo($query);
                } else if ($embed ==='invitations') {
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
            throw new EventExceptionNotFound("event $id not found");
        }
    }

    // create event
public function  postEvent(array $data) : Event{
        $event = new Event;
        $event->title = $data['event_title'];
    $event->description = $data['event_description'];
    $event->lieu = $data['event_place'];
    $event->date = $data['event_date'];
    $event->status = $data['event_status'];
    $event->user_id = $data['created_by'];

    try {
        $event->save();
    } catch (ModelNotFoundException ){
        throw new  EventExceptionNotFound("post event not resolvable ! ");
    }
    return $event;
}
    public function updateEvent(string $id,array $data): void
    {
        try {
            $event = Event::findOrFail($id);
        }catch (ModelNotFoundException $e){
            throw new EventExceptionNotFound("event $id not found");
        }
        if (isset($data['event_title'])) {
            $event->title = $data['event_title'];
        }
        if (isset($data['event_description'])) {
            $event->description = $data['event_description'];
        }
        if (isset($data['event_place'])) {
            $event->lieu = $data['event_place'];
        }
        if (isset($data['event_status'])) {
            $event->status = $data['event_status'];
        }

        $event->save();
    }


}
