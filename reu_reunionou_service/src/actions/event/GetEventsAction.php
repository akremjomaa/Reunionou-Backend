<?php


namespace events\actions\event;


use events\services\utils\EventService;
use Respect\Validation\Exceptions\Exception;
use Slim\Routing\RouteContext;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;


final class GetEventsAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        try {
            $eventService = new EventService();
            $events = $eventService->getEvents();


        } catch (Exception $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }
        $data = [
            'type' => 'collection',
            'count' => count($events),
            'events' =>
                $events
        ];

        $response = $response->withHeader('Content-type', 'application/json;charset=utf-8')->withStatus(202);
        $response->getBody()->write(json_encode($data));

        return $response;
    }
}
