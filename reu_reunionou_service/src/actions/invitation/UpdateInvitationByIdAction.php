<?php

namespace events\actions\invitation;
use events\errors\exceptions\InvitationExceptionNotFound;
use events\services\utils\InvitationService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;

class UpdateInvitationByIdAction
{
    public function __invoke(Request $request,
                             Response $response , array $args): Response{
        $invitationService = new InvitationService();

        $body = $request->getParsedBody();

        try {
            $invitationService->updateInvitation($args['id'], $body);
        }catch ( InvitationExceptionNotFound $e){
            throw new HttpNotFoundException($request, $e->getMessage());
        }

        return $response->withHeader('Content-type', 'application/json;charset=utf-8')->withStatus(204);
    }
}
