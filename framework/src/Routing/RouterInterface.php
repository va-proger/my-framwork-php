<?php

namespace Somecode\Framework\Routing;

use League\Container\Container;
use Somecode\Framework\Http\Request;

interface RouterInterface
{
    public function dispatch(Request $request, Container $container);

    public function registerRoutes(array $routes): void;
}
