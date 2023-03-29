<?php

namespace config;

require_once __DIR__ . '/../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager;
use Slim\Factory\AppFactory;

$config = parse_ini_file('config.db.ini');

$db = new Manager();
$db->addConnection($config);
$db->setAsGlobal();
$db->bootEloquent();

$app = AppFactory::create();

(require __DIR__ . '/middleware.php')($app);
(require __DIR__ . '/routes.php')($app);

return $app;
