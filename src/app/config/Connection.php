<?php
namespace App\Config;

use PDO;
use PDOException;

class Connection
{
    private static $connection = null;

    private static string $host = 'localhost';
    private static string $port = '3306';
    private static string $db   = 'academia';
    private static string $user = 'root';
    private static string $pass = '';
    private static string $charset = 'utf8mb4';

    private function __construct() {}
    private function __clone() {}

    private static function setEnvConnection(): void
    {
        self::$host = $_ENV['DB_HOST'] ?? self::$host;
        self::$db   = $_ENV['DB_NAME'] ?? self::$db;
        self::$user = $_ENV['DB_USER'] ?? self::$user;
        self::$pass = $_ENV['DB_PASS'] ?? self::$pass;
    }

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            self::setEnvConnection();

            try {
                $dsn = sprintf(
                    "mysql:host=%s;port=%s;dbname=%s;charset=%s",
                    self::$host,
                    self::$port,
                    self::$db,
                    self::$charset
                );
                
                self::$connection = new PDO($dsn, self::$user, self::$pass, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]);

            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode([
                    'error' => 'Erro ao conectar no banco de dados',
                    'message' => $e->getMessage()
                ]);
                exit;
            }
        }

        return self::$connection;
    }
}
