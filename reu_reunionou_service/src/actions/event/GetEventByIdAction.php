<?php
namespace events\actions\event;


use events\errors\exceptions\EventExceptionNotFound;
use events\services\utils\EventService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Routing\RouteContext;

final class GetEventByIdAction
{
// get event by id with his own link and all the links towards related models (invitations , comments and user)
    public function __invoke(Request $request, Response $response, array $args): Response
    {

        try {
            // adding optional embed for getting comments , invitations and user related to this event

            $embeds = $request->getQueryParams()['embed'] ?? null;

            if ($embeds !== null){
                $embeds = explode(',', $embeds);
            }

            $eventService = new EventService();
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $event = $eventService->getEventById($args['id'], $embeds);
        } catch (EventExceptionNotFound $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }

        // adding links towards invitations , comments and user .
        $data = [
            'type' => 'resource',
            'event' => $event,
            'links' => [
                'invitations' => [
                    'href' => $routeParser->urlFor('getEventInvitationsById', ['id' => $event['id']])
                ],
                'comments' => [
                    'href' => $routeParser->urlFor('getEventCommentsById', ['id' => $event['id']])
                ],
                'created by' => [
                    'href' => $routeParser->urlFor('getEventUserById', ['id' => $event['id']])
                ],
                'self' => [
                    'href' => $routeParser->urlFor('getEventById', ['id' => $event['id']])
                ]
            ]
        ];

        $response = $response->withHeader('Content-type', 'application/json;charset=utf-8')->withStatus(202);
        $response->getBody()->write(json_encode($data));

        return $response;
    }
}