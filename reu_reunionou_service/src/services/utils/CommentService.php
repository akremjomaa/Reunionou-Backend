<?php
namespace events\services\utils;


use events\errors\exceptions\EventExceptionNotFound;
use events\models\Comment;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class CommentService{

    public function  postComment (array $data) : Comment{
        $comment = new Comment();
        $comment->content = $data['content'];
        $comment->event_id = $data['event'];

        if (isset($data['created_by'])) {
            $comment->user_id = $data['created_by'];
        }
        if (isset($data['username'])) {
            $comment->user_name = $data['username'];
        }

        try {
            $comment->save();
        } catch (ModelNotFoundException ){
            throw new  EventExceptionNotFound("post comment not resolvable ! ");
        }
        return $comment;
    }

    public static function DeleteComment(int $id) {
        try {
            $query = Comment::find($id);
            return $query->delete();
        } catch (\Throwable $ex) {
            throw $ex;
        }
    }

}