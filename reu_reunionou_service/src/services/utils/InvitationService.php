<?php
namespace events\services\utils;


use events\errors\exceptions\EventExceptionNotFound;
use events\models\Invitation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class InvitationService{

    public function  postInvitation (array $data) : Invitation{
        $invitation = new Invitation;
        if (isset($data['invitation_date'])) {
            $invitation->date = $data['invitation_date'];
        }
        if (isset($data['invitation_status'])) {
            $invitation->status = $data['invitation_status'];
        }
        $invitation->user_id = $data['invited'];
        $invitation->event_id = $data['event'];

        try {
            $invitation->save();
        } catch (ModelNotFoundException ){
            throw new  EventExceptionNotFound("post invitation not resolvable ! ");
        }
        return $invitation;
    }
}