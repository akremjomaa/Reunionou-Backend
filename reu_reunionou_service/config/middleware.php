<?php

namespace config;

use http\Client\Response;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpMethodNotAllowedException;
use Throwable;

use events\errors\renderer\ErrorRenderer;
use Psr\Http\Message\ResponseInterface;
use Slim\App;



return function (App $app) {
    $app->addBodyParsingMiddleware();

    $app->options('/{routes:.+}', function ($request, $response, $args) {
        return $response;
    });

    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
           ->withHeader('Access-Control-Allow-Credentials', 'true');
    });



    $app->addRoutingMiddleware();

    $errorMiddleware = $app->addErrorMiddleware(true, true, true);
    $errorHandler = $errorMiddleware->getDefaultErrorHandler();
    $errorHandler->registerErrorRenderer('application/json', ErrorRenderer::class);
    $errorHandler->forceContentType('application/json');

    $errorMiddleware->setErrorHandler(HttpMethodNotAllowedException::class, function (ServerRequestInterface $request, Throwable $exception, bool $displayErrorDetails): ResponseInterface
    {
        $response = new \Slim\Psr7\Response();
        $response->getBody()->write('405 method not allowed.');

        return $response->withStatus(405);
    });


    
};
