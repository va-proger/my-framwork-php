<?php

namespace Somecode\Framework\Routing;

use Somecode\Framework\Http\Request;

interface RouterInterface
{
    public function dispatch(Request $request);
}
