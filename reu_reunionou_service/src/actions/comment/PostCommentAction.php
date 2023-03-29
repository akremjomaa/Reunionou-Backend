<?php

namespace events\actions\comment;

use events\errors\exceptions\EventExceptionNotFound;
use events\services\utils\CommentService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;

final class PostCommentAction {

    // creating comment
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        try {
            $commentService = new CommentService();
            $comment = $commentService->postComment($data);
        } catch (EventExceptionNotFound $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }

        $data = [
            'type' => 'ressource',
            'comment' => $comment
        ];

        $response = $response->withHeader('Content-type', 'application/json;charset=utf-8')->withStatus(202);
        $response->getBody()->write(json_encode($data));

        return $response;
    }
}
