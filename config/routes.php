<?php

namespace config;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

use events\middlewares\ValidatorPutOrderMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (App $app) {
    $app->group('/', function (RouteCollectorProxy $app) {
        $app->get('users[/]', \events\actions\GetUsersAction::class)->setName('users');
        $app->get('user/{id}[/]', \events\actions\GetUserByIdAction::class)->setName('user');
        $app->post('users/new[/]', \events\actions\PostUserAction::class)->setName('create-user');
        $app->put('user/{id}[/]', \events\actions\PutUserAction::class)->setName('modify-user');
        $app->delete('user/{id}[/]', \events\actions\DeleteUserAction::class)->setName('delete-user');
   });
};
