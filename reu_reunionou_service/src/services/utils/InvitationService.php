<?php
namespace events\services\utils;


use events\errors\exceptions\EventExceptionNotFound;
use events\errors\exceptions\InvitationExceptionNotFound;
use events\models\Invitation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class InvitationService{


    public function getInvitationById(string $id, ?array $embeds=null): array
    {
        $query = Invitation::select()->where('id', '=', $id);
        if ($embeds !== null){
            foreach ($embeds as $embed) {
                if ($embed === 'user'){
                    $query = $query->with(['user' => function($query){
                        $query->select('id','name','firstname','email');
                    }]);
                    // echo($query);
                } else if ($embed === 'event') {
                    $query = $query->with('event');
                }
            }
        }
        try {
            return $query->firstOrFail()->toArray();
        }catch (ModelNotFoundException $e) {
            throw new InvitationExceptionNotFound("invitation $id not found");
        }
    }

    // create invitation
    public function  postInvitation (array $data) : Invitation{
        $invitations = Invitation::class;
        foreach ($data['invited'] as $invitedId){


        $invitation = new Invitation;

        // invitation date can be nullable

        if (isset($data['invitation_date'])) {
            $invitation->invitation_date = $data['invitation_date'];
        }
        // invitation status can be nullable


                $invitation->status = "en attente";


            if (isset($invitedId)){
                $invitation->user_id = $invitedId;

            }
            if (isset($data['event'])) {
                $invitation->event_id = $data['event'];
            }
        try {
            $invitation->save();
            $invitations = $invitation;
        } catch (ModelNotFoundException ){
            throw new  EventExceptionNotFound("post invitation not resolvable ! ");
        }
    }
        return $invitations;
    }

    public function updateInvitation(int $id , array $data) : void {
        try {
            $invitation = Invitation::findOrFail($id);
        }catch (ModelNotFoundException $e){
            throw new InvitationExceptionNotFound("invitation $id not found");
        }
        if (isset($data['status'])) {
            $invitation->status = $data['status'];
        }

        $invitation->save();
    }
}
