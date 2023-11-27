<?php

namespace Somecode\Framework\Console\Commands;

use Somecode\Framework\Console\CommandInterface;

class MigrateCommand implements CommandInterface
{
    private string $name = 'migrate';

    public function execute(array $parameters = []): int
    {
        dd($parameters);

        return 0;
    }
}
