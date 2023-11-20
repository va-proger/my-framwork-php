<?php

define('BASE_PATH', dirname(__DIR__));
require_once BASE_PATH.'/vendor/autoload.php';

use Somecode\Framework\Http\Kernel;
use Somecode\Framework\Http\Request;
use Somecode\Framework\Routing\Router;

$request = Request::createFromGlobals();

$router = new Router();

$kernel = new Kernel($router);
$response = $kernel->handle($request);

$response->send();
