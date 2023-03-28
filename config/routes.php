<?php

namespace config;

use events\actions\event\GetEventByIdAction;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;



return function (App $app) {
    $app->group('/events', function (RouteCollectorProxy $app) {
        $app->get('[/]', \events\actions\event\GetEventsAction::class)->setName('getEvents');
        $app->get('/{id}[/]', GetEventByIdAction::class)->setName('getEventById');
        $app->get('/{id}/user[/]', \events\actions\event\GetEventUserByIdAction::class)->setName('getEventUserById');
        $app->get('/{id}/invitations[/]', \events\actions\event\GetEventInvitationsByIdAction::class)->setName('getEventInvitationsById');
        $app->get('/{id}/comments[/]', \events\actions\event\GetEventCommentsByIdAction::class)->setName('getEventCommentsById');
        $app->post('[/]', \events\actions\event\PostEventAction::class)->setName('postEvent');

    });

    $app->group('/invitations', function (RouteCollectorProxy $app){
        $app->post('[/]', \events\actions\invitation\PostInvitationAction::class)->setName('postInvitation');
    });
};
