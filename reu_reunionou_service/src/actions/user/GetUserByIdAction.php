<?php

namespace events\actions\user;

use events\services\utils\UserService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpMethodNotAllowedException;

final class GetUserByIdAction
{
    public function __invoke(Request $request, Response $response, mixed $args): Response
    {
            $request->getMethod() != "GET" ?? throw new HttpMethodNotAllowedException($request, "Methode non autorisée");

        try {

            $user = UserService::GetUserById($args['id']);

            $data = [
                'type' => 'resource',
                'count' => count($user),
                'user' => [],
            ];

            foreach ($user as $key => $value) {
                $data["user"] = $value;
            }

            $response = $response->withStatus($response->getStatusCode())->withHeader('Content-Type', 'application/json');
            $response->getBody()->write(json_encode($data));
            return $response;
        } catch (\Throwable $ex) {
            throw $ex;
        }
    }
}
