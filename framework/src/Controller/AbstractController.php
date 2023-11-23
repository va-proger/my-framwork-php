<?php

namespace Somecode\Framework\Controller;

use Psr\Container\ContainerInterface;
use Somecode\Framework\Http\Response;

abstract class AbstractController
{
    protected ?ContainerInterface $container = null;

    public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }

    public function render(string $view, array $parameters = [], Response $response = null): Response
    {
        $content = $this->container->get('twig')->render($view, $parameters);

        $response ??= new Response();

        $response->setContent($content);

        return $response;
    }
}
