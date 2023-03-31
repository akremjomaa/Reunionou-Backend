<?php

namespace events\actions\comment;

use events\services\utils\CommentService;
use events\services\utils\UserService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Exception\HttpMethodNotAllowedException;

final class DeleteCommentAction {
    public function __invoke(Request $request, Response $response, mixed $args): Response {
            $request->getMethod() != "DELETE" ?? throw new HttpMethodNotAllowedException($request, "Methode non autorisée");

        try {

            if (CommentService::DeleteComment($args['id'])) {
                $response = $response->withHeader('Content-type', 'application/json;charset=utf-8')->withStatus(202);
                $response->getBody();

                return $response;
            } else {
                throw new HttpInternalServerErrorException($request, "Le commentaire n'existe pas !");
            }
        } catch (\Throwable $ex) {
            throw $ex;
        }
    }
}
