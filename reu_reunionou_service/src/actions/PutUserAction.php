<?php

namespace events\actions;

use events\errors\exceptions\HttpNoContentException;
use events\services\ReunionouService;
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
            if (ReunionouService::ModifyUser($args["id"], $data)) {
                throw new HttpNoContentException($request);
            } else {
                throw new HttpInternalServerErrorException($request, "L'utilisateur n'a pû être modifié");
            }
        } else {
            throw new HttpInternalServerErrorException($request, "La requête n'a pas pu aboutir.");
        }
    }
}
