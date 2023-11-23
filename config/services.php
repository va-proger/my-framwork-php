<?php

use Doctrine\DBAL\Connection;
use League\Container\Argument\Literal\ArrayArgument;
use League\Container\Argument\Literal\StringArgument;
use League\Container\Container;
use League\Container\ReflectionContainer;
use Somecode\Framework\Console\Application;
use Somecode\Framework\Console\Kernel as ConsoleKernel;
use Somecode\Framework\Controller\AbstractController;
use Somecode\Framework\Dbal\ConnectionFactory;
use Somecode\Framework\Http\Kernel;
use Somecode\Framework\Routing\Router;
use Somecode\Framework\Routing\RouterInterface;
use Symfony\Component\Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$dotenv = new Dotenv();
$dotenv->load(BASE_PATH.'/.env');

// Application parameters
$routes = include BASE_PATH.'/routes/web.php';
$appEnv = $_ENV['APP_NEW'] ?? 'local';
$viewsPath = BASE_PATH.'/views';
$databaseUrl = 'pdo-mysql://my_frame:sAMogyg6.@localhost:3306/my_frame?charset=utf8mb4';
//Application services
$container = new Container();

$container->delegate(new ReflectionContainer(true));
// добавляем пространство имен для консоли
$container->add('framework-commands-namespace', new StringArgument('Somecode\\Framework\\Console\\Commands\\'));

$container->add('APP_ENV', new StringArgument($appEnv));

$container->add(RouterInterface::class, Router::class);

$container->extend(RouterInterface::class)->addMethodCall('registerRoutes', [new ArrayArgument($routes)]);

$container->add(Kernel::class)->addArgument(RouterInterface::class)->addArgument($container);

$container->addShared('twig-loader', FilesystemLoader::class)->addArgument(new StringArgument($viewsPath));

$container->addShared('twig', Environment::class)->addArgument('twig-loader');

$container->inflector(AbstractController::class)->invokeMethod('setContainer', [$container]);

$container->add(ConnectionFactory::class)->addArgument(new StringArgument($databaseUrl));

$container->addShared(Connection::class, function () use ($container): Connection {
    return $container->get(ConnectionFactory::class)->create();
});

$container->add(ConsoleKernel::class)->addArgument($container)->addArgument(Application::class);

return $container;
