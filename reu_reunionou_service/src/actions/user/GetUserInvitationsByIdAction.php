<?php

namespace events\actions\user;


use events\errors\exceptions\EventExceptionNotFound;
use events\services\utils\UserService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;

final class GetUserInvitationsByIdAction
{
    //get invitations related to this user
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        try{

            $userEvent = new UserService();

            $invitations = $userEvent->getUserInvitations($args['id']);
        } catch (EventExceptionNotFound $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }

        $data = [
            'type' => 'collection',
            'count' => count($invitations),
            'invitations' => $invitations,
        ];

        $response = $response->withHeader('Content-type', 'application/json;charset=utf-8')->withStatus(200);
        $response->getBody()->write(json_encode($data));

        return $response;
    }
}
