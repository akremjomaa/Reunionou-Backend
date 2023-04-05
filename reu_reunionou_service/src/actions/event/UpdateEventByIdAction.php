<?php

namespace events\actions\event;



use events\errors\exceptions\EventExceptionNotFound;
use events\services\utils\EventService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;

class UpdateEventByIdAction
{
    public function __invoke(Request $request,
                             Response $response , array $args): Response{
        $eventService = new EventService();

        $body = $request->getParsedBody();

        try {
            $eventService->updateEvent($args['id'], $body);
        }catch ( EventExceptionNotFound $e){
            throw new HttpNotFoundException($request, $e->getMessage());
        }

        return $response->withHeader('Content-type', 'application/json;charset=utf-8')->withStatus(204);
    }
}
