<?php

namespace events\actions\user;

use events\services\utils\UserService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpMethodNotAllowedException;
use Slim\Routing\RouteContext;

final class GetUsersAction
{
    public function __invoke(Request $request, Response $response): Response
    {
            $request->getMethod() != "GET" ?? throw new HttpMethodNotAllowedException($request, "Methode non autorisée");
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        try {

            $users = UserService::getUsers();

            $data = [
                'type' => 'collection',
                'count' => count($users),
                'users' => [],
            ];

            foreach ($users as $key => $value) {
                $data["users"][$key] = $value;
                $data["users"][$key]["links"]["self"]["href"] = $routeParser->urlFor("user", ["id" => $value["id"]]);
            }

            $response = $response->withStatus($response->getStatusCode())->withHeader('Content-Type', 'application/json');
            $response->getBody()->write(json_encode($data));
            return $response;
        } catch (\Throwable $ex) {
            throw $ex;
        }
    }
}
