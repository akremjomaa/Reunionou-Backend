<?php

namespace events\actions;

use events\services\ReunionouService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpMethodNotAllowedException;
use Throwable;

final class GetUsersAction
{
    /**
     * @throws Throwable
     */
    public function __invoke(Request $request, Response $response): Response
    {
            $request->getMethod() != "GET" ?? throw new HttpMethodNotAllowedException($request, "Methode non autorisée");

        try {

            $users = ReunionouService::getUsers();

            $data = [
                'type' => 'collection',
                'count' => count($users),
                'users' => [],
            ];

            foreach ($users as $key => $value) {
                $data["users"][$key] = $value;
            }

            $response = $response->withStatus($response->getStatusCode())->withHeader('Content-Type', 'application/json');
            $response->getBody()->write(json_encode($data));
            return $response;
        } catch (Throwable $ex) {
            throw $ex;
        }
    }
}
