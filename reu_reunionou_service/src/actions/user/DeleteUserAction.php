<?php

namespace events\actions\user;

use events\errors\exceptions\HttpNoContentException;
use events\services\utils\UserService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Exception\HttpMethodNotAllowedException;

final class DeleteUserAction {
    public function __invoke(Request $request, Response $response, mixed $args): Response {
        $request->getMethod() != "DELETE" ?? throw new HttpMethodNotAllowedException($request, "Methode non autorisée");

        try {

            if (UserService::DeleteUser($args['id'])) {
                throw new HttpNoContentException($request);
            } else {
                throw new HttpInternalServerErrorException($request, "L'utilisateur n'existe pas !");
            }
        } catch (\Throwable $ex) {
            throw $ex;
        }
    }
}