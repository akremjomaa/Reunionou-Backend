<?php

namespace events\actions\event;


use events\errors\exceptions\EventExceptionNotFound;
use events\services\utils\EventService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;

final class GetEventCommentsByIdAction
{
    //get comments related to this event

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        try{
            $eventService = new EventService();
            $comments = $eventService->getEventComments($args['id']);
        } catch (EventExceptionNotFound $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }

        $data = [
            'type' => 'collection',
            'count' => count($comments),
            'comments' => $comments,
        ];

        $response = $response->withHeader('Content-type', 'application/json;charset=utf-8')->withStatus(200);
        $response->getBody()->write(json_encode($data));

        return $response;
    }
}
