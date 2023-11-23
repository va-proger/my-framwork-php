<?php

namespace Somecode\Framework\Console;

use Psr\Container\ContainerInterface;

class Kernel
{
    public function __construct(
        private ContainerInterface $container,
        private Application $aplication
    ) {
    }

    public function handle(): int
    {
        $this->registerCommands();
        $status = $this->aplication->run();
        dd($status);

        return 0;
    }

    private function registerCommands(): void
    {
        // DirectoryIterator встроен в php
        $commandFiles = new \DirectoryIterator(__DIR__.'/Commands');
        //  получаем пространство имен
        $namespace = $this->container->get('framework-commands-namespace');

        // проходимся по всем файлам
        foreach ($commandFiles as $commandFile) {
            // проверяем является файлом
            if (! $commandFile->isFile()) {
                continue;
            }
            // получаем полный путь до нашей команды
            $command = $namespace.pathinfo($commandFile, PATHINFO_FILENAME);
            // если подкласс CommandInterface
            if (is_subclass_of($command, CommandInterface::class)) {

                $name = (new \ReflectionClass($command))->getProperty('name')->getDefaultValue();
                $this->container->add("console:$name", $command);
            }
        }
    }
}
