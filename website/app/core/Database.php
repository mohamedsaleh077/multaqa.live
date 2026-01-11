<?php


// I used https://github.com/Wagner-Souza/eloquent-orm/blob/main/orm/Database.php as a reference


namespace core;

use PDO;
use PDOException;
use RuntimeException;
use PDOStatement;

class Database {
    private static $config;
    private static $connection;

    // check for connection
    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            if (empty(self::$config)) {
                self::$config = parse_ini_file(__DIR__ . '/../config.ini');
            }
            self::connect();
        }

        return self::$connection;
    }

    // connect to database
    private static function connect(): void
    {
        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=%s',
            self::$config['dbhost'],
            self::$config['port'],
            self::$config['dbname'],
            self::$config['charset']
        );

        try {
            self::$connection = new PDO(
                $dsn,
                self::$config['username'],
                self::$config['password'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (PDOException $e) {
            throw new RuntimeException("DB CONN: " . $e->getMessage());
        }
    }

    // execute a query
    private static function execute(string $sql, array $params = []): PDOStatement
    {
        $connection = self::getConnection();
        $statement = $connection->prepare($sql);
        $statement->execute($params);

        return $statement;
    }



    // public functions
    // getting all raws
    public static function fetchAll(string $sql, array $params = []): array
    {
        return self::execute($sql, $params)->fetchAll();
    }

    // get one raw
    public static function fetchOne(string $sql, array $params = []): array | bool
    {
        return self::execute($sql, $params)->fetch();
    }

    // last insert id
    public static function lastInsertId(): string
    {
        return self::getConnection()->lastInsertId();
    }

    public static function disconnect(): void
    {
        self::$connection = null;
    }
}
