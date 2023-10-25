<?php
namespace Src\System;
use PDO;

class DatabaseConfiguration {

    private static $connection;

    public static function getConnection() {
        $host = getenv('DB_HOST');
        $port = getenv('DB_PORT');
        $db   = getenv('DB_DATABASE');
        $user = getenv('DB_USERNAME');
        $pass = getenv('DB_PASSWORD');
        $conStr = sprintf("pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s", 
                $host, 
                $port, 
                $db, 
                $user, 
                $pass
            );
        if (self::$connection === null) {
            self::$connection = new PDO($conStr);
        }

        return self::$connection;
    }
}