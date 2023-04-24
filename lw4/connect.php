<?php
declare(strict_types=1);
/**
 * @return array{dsn:string,username:string,password:string}
 */

function getConnectionData(): array
{
    $connectionDataJson = file_get_contents('configuration.json');
    $connectionData = json_decode($connectionDataJson, true);
    return $connectionData;
}

function connectDatabase(): PDO
{
    $connectionData = getConnectionData();
    $dsn = $connectionData['dsn'];
    $user = $connectionData['user'];
    $password = $connectionData['password'];
    return new PDO($dsn, $user, $password);
}