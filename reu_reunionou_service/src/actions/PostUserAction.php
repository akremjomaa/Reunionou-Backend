<?php

namespace events\actions;

use events\services\ReunionouService;
use lbs\order\errors\exceptions\HttpNoContentException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Exception\HttpMethodNotAllowedException;
use Slim\Exception\HttpNotFoundException;
use Throwable;

final class PostUserAction
{
    /**
     * @throws Throwable
     */
    public function __invoke(Request $request, Response $response): Response
    {
            $request->getMethod() != "POST" ?? throw new HttpMethodNotAllowedException($request, "Methode non autorisée");
            $data = $request->getParsedBody() ?? throw new HttpNotFoundException($request, "Données non récupérées");

        try {

            if (ReunionouService::CreateUser($data)) {
                throw new HttpNoContentException($request);
            } else {
                throw new HttpInternalServerErrorException($request, "La ressource n'a pû être enregistée");
            }
        } catch (Throwable $ex) {
            throw $ex;
        }
    }
}
