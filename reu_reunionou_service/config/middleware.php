<?php

namespace config;

use events\middlewares\CorsMiddleware;
use http\Client\Response;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpMethodNotAllowedException;
use Slim\Exception\HttpNotFoundException;
use Throwable;

use events\errors\renderer\ErrorRenderer;
use Slim\App;



return function (App $app) {
    $app->addBodyParsingMiddleware();

    $app->options('/{routes:.+}', function ($request, $response, $args) {
        return $response;
    });

    $app->add(new CorsMiddleware());



    $app->addRoutingMiddleware();

    $errorMiddleware = $app->addErrorMiddleware(true, true, true);
    $errorHandler = $errorMiddleware->getDefaultErrorHandler();
    $errorHandler->registerErrorRenderer('application/json', ErrorRenderer::class);
    $errorHandler->forceContentType('application/json');

    $errorMiddleware->setErrorHandler(HttpMethodNotAllowedException::class, function (ServerRequestInterface $request, Throwable $exception, bool $displayErrorDetails): Response
    {
        $response = new Response();
        $response->getBody()->write('405 method not allowed.');

        return $response->withStatus(405);
    });
};
