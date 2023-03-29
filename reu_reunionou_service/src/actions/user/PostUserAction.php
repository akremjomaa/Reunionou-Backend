<?php

namespace events\actions\user;

use events\errors\exceptions\HttpNoContentException;
use events\services\utils\UserService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Exception\HttpMethodNotAllowedException;
use Slim\Exception\HttpNotFoundException;

final class PostUserAction
{
    public function __invoke(Request $request, Response $response): Response
    {
            $request->getMethod() != "POST" ?? throw new HttpMethodNotAllowedException($request, "Methode non autorisée");
            $data = $request->getParsedBody() ?? throw new HttpNotFoundException($request, "Données non récupérées");

        try {

            if (UserService::CreateUser($data)) {
                throw new HttpNoContentException($request);
            } else {
                throw new HttpInternalServerErrorException($request, "L'utilisateur n'a pû être enregisté");
            }
        } catch (\Throwable $ex) {
            throw $ex;
        }
    }
}
