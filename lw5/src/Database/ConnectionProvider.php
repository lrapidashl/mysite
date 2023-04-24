<?php
declare(strict_types=1);
/**
 * @return array{dsn:string,username:string,password:string}
 */

namespace App\Database;

class ConnectionProvider
{
    private static function getConnectionData(): array
    {
        $connectionDataJson = file_get_contents(__DIR__ . '/configuration.json');
        $connectionData = json_decode($connectionDataJson, true);
        return $connectionData;
    }

    public static function connectDatabase(): \PDO
    {
        $connectionData = self::getConnectionData();
        $dsn = $connectionData['dsn'];
        $user = $connectionData['user'];
        $password = $connectionData['password'];
        return new \PDO($dsn, $user, $password);
    }
}