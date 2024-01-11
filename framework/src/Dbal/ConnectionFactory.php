<?php

namespace Somecode\Framework\Dbal;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class ConnectionFactory
{
    public function __construct(
        private readonly string $databaseUrl
    ) {
    }

    public function create(): Connection
    {
        $connection = DriverManager::getConnection([
            'url' => $this->databaseUrl,
        ]);

        $connection->setAutoCommit(false);

        return $connection;
    }
}
