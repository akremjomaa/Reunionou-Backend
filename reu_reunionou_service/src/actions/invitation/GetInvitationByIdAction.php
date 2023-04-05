<?php
namespace events\actions\invitation;


use events\errors\exceptions\EventExceptionNotFound;
use events\errors\exceptions\InvitationExceptionNotFound;
use events\services\utils\EventService;
use events\services\utils\InvitationService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Routing\RouteContext;

final class GetInvitationByIdAction
{
// get INVITATION by id with his own link and all the links towards related models (event and user)
    public function __invoke(Request $request, Response $response, array $args): Response
    {

        try {
            // adding optional embed for getting event and user related to this invitation

            $embeds = $request->getQueryParams()['embed'] ?? null;

            if ($embeds !== null){
                $embeds = explode(',', $embeds);
            }

            $invitationService = new InvitationService();
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $invitation = $invitationService->getInvitationById($args['id'], $embeds);
        } catch (InvitationExceptionNotFound $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }

        $data = [
            'type' => 'resource',
            'invitation' => $invitation,
            'links' => [
                'self' => [
                    'href' => $routeParser->urlFor('getInvitationById', ['id' => $invitation['id']])
                ]
            ]
        ];

        $response = $response->withHeader('Content-type', 'application/json;charset=utf-8')->withStatus(202);
        $response->getBody()->write(json_encode($data));

        return $response;
    }
}