<?php

namespace Lunaris\Framework\ORM;

use Pixie\Connection;
use Pixie\QueryBuilder\QueryBuilderHandler;

class DB
{
    private static $connection; // Holds the Connection instance
    private static $queryBuilder; // Holds the QueryBuilderHandler instance
    private static $transactionActive = false;

    private static function initialize()
    {
        if (!self::$connection) {
            $config = require __DIR__ . '/../../../../app/Config/db.php';
            self::$connection = new Connection($config['driver'], $config);
            self::$queryBuilder = new QueryBuilderHandler(self::$connection);
        }
    }

    // Get the shared QueryBuilder instance
    public static function getQueryBuilder()
    {
        self::initialize();
        return self::$queryBuilder;
    }

    // Get the PDO instance
    public static function getPdo()
    {
        self::initialize();
        return self::$connection->getPdoInstance(); // Access the PDO instance from QueryBuilderHandler
    }

    // Begin a transaction
    public static function beginTransaction()
    {
        if (!self::$transactionActive) {
            self::getPdo()->beginTransaction();
            self::$transactionActive = true;
        }
    }

    // Commit a transaction
    public static function commit()
    {
        if (self::$transactionActive) {
            self::getPdo()->commit();
            self::$transactionActive = false;
        }
    }

    // Rollback a transaction
    public static function rollBack()
    {
        if (self::$transactionActive) {
            self::getPdo()->rollBack();
            self::$transactionActive = false;
        }
    }
}
