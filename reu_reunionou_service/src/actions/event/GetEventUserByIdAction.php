<?php

namespace events\actions\event;


use events\errors\exceptions\EventExceptionNotFound;
use events\services\utils\EventService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;

final class GetEventUserByIdAction
{

    //get user who is invited to this event

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        try{
            $eventService = new EventService();
            $user = $eventService->getEventUser($args['id']);
        } catch (EventExceptionNotFound $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }

        $data = [
            'type' => 'resource',
            'user' => $user,
        ];

        $response = $response->withHeader('Content-type', 'application/json;charset=utf-8')->withStatus(200);
        $response->getBody()->write(json_encode($data));

        return $response;
    }
}
