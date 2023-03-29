<?php

namespace config;

use events\actions\event\GetEventByIdAction;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;


return function (App $app) {

    // event  routes

    $app->group('/events', function (RouteCollectorProxy $app) {
        $app->get('[/]', \events\actions\event\GetEventsAction::class)->setName('getEvents');
        $app->get('/{id}[/]', GetEventByIdAction::class)->setName('getEventById');
        $app->get('/{id}/user[/]', \events\actions\event\GetEventUserByIdAction::class)->setName('getEventUserById');
        $app->get('/{id}/invitations[/]', \events\actions\event\GetEventInvitationsByIdAction::class)->setName('getEventInvitationsById');
        $app->get('/{id}/comments[/]', \events\actions\event\GetEventCommentsByIdAction::class)->setName('getEventCommentsById');
        $app->post('[/]', \events\actions\event\PostEventAction::class)->setName('postEvent');

    });

    // invitation routes
    $app->group('/invitations', function (RouteCollectorProxy $app){
        $app->post('[/]', \events\actions\invitation\PostInvitationAction::class)->setName('postInvitation');
    });

    // comment routes

    $app->group('/comments', function (RouteCollectorProxy $app){
        $app->post('[/]', \events\actions\comment\PostCommentAction::class)->setName('postComment');
    });

    // user routes

       $app->group('/users', function (RouteCollectorProxy $app) {
        $app->get('[/]', \events\actions\user\GetUsersAction::class)->setName('users');
        $app->get('/{id}[/]', \events\actions\user\GetUserByIdAction::class)->setName('user');
        $app->post('/new[/]', \events\actions\user\PostUserAction::class)->setName('create-user');
        $app->put('/{id}[/]', \events\actions\user\PutUserAction::class)->setName('modify-user');
        $app->delete('/{id}[/]', \events\actions\user\DeleteUserAction::class)->setName('delete-user');
   });
 
};
