<?php

namespace events\actions\event;

use events\errors\exceptions\EventExceptionNotFound;
use events\services\utils\EventService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;

final class PostEventAction {


    // create event
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        try {
            $eventService = new EventService();
            $event = $eventService->postEvent($data);
        } catch (EventExceptionNotFound $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }

        $data = [
            'type' => 'ressource',
            'event' => $event
        ];

        $response = $response->withHeader('Content-type', 'application/json;charset=utf-8')->withStatus(202);
        $response->getBody()->write(json_encode($data));

        return $response;
    }
}
