<?php

namespace App\Controllers;

use Somecode\Framework\Http\Response;

class PostController
{
    public function show(int $id): Response
    {
        $content = "<h1>Posts - $id </h1>";

        return new Response($content);
    }
}
