<?php

namespace events\actions\invitation;

use events\errors\exceptions\EventExceptionNotFound;
use events\services\utils\InvitationService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;

final class PostInvitationAction {

    // create invitation
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        try {
            $invitationService = new InvitationService();
            $invitation = $invitationService->postInvitation($data);
        } catch (EventExceptionNotFound $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }

        $data = [
            'type' => 'ressource',
            'invitation' => $invitation
        ];

        $response = $response->withHeader('Content-type', 'application/json;charset=utf-8')->withStatus(202);
        $response->getBody()->write(json_encode($data));

        return $response;
    }
}

