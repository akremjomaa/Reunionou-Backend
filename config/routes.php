<?php

namespace config;

use events\actions\event\GetEventByIdAction;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;



return function (App $app) {
    $app->group('/v1', function (RouteCollectorProxy $app) {
        $app->get('/events[/]', \events\actions\event\GetEventsAction::class)->setName('getEvents');
        $app->get('/events/{id}[/]', GetEventByIdAction::class)->setName('getEventById');

    });
};
