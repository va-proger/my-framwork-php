<?php

use League\Container\Container;
use Somecode\Framework\Http\Kernel;
use Somecode\Framework\Routing\Router;
use Somecode\Framework\Routing\RouterInterface;

$container = new Container();
$container->add(RouterInterface::class, Router::class);
$container->add(Kernel::class)->addArgument(RouterInterface::class);

return $container;
