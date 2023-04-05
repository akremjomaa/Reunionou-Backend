<?php

namespace events\actions\user;

use events\errors\exceptions\HttpNoContentException;
use events\services\utils\UserService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Exception\HttpMethodNotAllowedException;
use Slim\Exception\HttpNotFoundException;

final class PutUserAction
{
    public function __invoke(Request $request, Response $response, mixed $args): Response
    {
        $request->getMethod() != "PUT" ?? throw new HttpMethodNotAllowedException($request, "Methode non autorisée");
        $data = $request->getParsedBody() ?? throw new HttpNotFoundException($request, "Données non récupérées");


        if (isset($data['name']) && isset($data['firstname']) && isset($data['email']) && isset($data['password'])) {
            if (UserService::ModifyUser($args["id"], $data)) {
                $response = $response->withHeader('Content-type', 'application/json;charset=utf-8')->withStatus(202);
                $response->getBody()->write(json_encode($data));

                return $response;
            } else {
                throw new HttpInternalServerErrorException($request, "L'utilisateur n'a pû être modifié");
            }
        } else {
            throw new HttpInternalServerErrorException($request, "La requête n'a pas pu aboutir.");
        }
    }
}
