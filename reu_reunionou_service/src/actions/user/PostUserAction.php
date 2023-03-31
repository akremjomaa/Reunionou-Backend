<?php

namespace events\actions\user;

use events\errors\exceptions\EventExceptionNotFound;

use events\services\utils\UserService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Exception\HttpNotFoundException;

final class PostUserAction
{
    public function __invoke(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        try {
            $userService = new UserService();
            $user = $userService->createUser($data);
        } catch (EventExceptionNotFound $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }

        $data = [
            'type' => 'ressource',
            'user' => $user
        ];

        $response = $response->withHeader('Content-type', 'application/json;charset=utf-8')->withStatus(202);
        $response->getBody()->write(json_encode($data));

        return $response;
    }
}
