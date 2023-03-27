<?php

namespace config;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

use events\middlewares\ValidatorPutOrderMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (App $app) {
    $app->group('/', function (RouteCollectorProxy $app) {

    });
};
