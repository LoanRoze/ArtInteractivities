<?php
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $envPath = realpath(__DIR__ . '/../../.env');
        // Lit le .env
        $env = parse_ini_file($envPath, false, INI_SCANNER_TYPED);
        
        if (!$env) {
            die("Impossible de lire le fichier .env !");
        }

        $host = $env['DB_HOST'] ?? '127.0.0.1';
        $db   = $env['DB_NAME'] ?? '';
        $user = $env['DB_USER'] ?? '';
        $pass = $env['DB_PASS'] ?? '';
        $charset = 'utf8mb4';

        // Debug : vérifie les variables
        echo "Host: $host<br>DB: $db<br>User: $user<br>Password: $pass<br>";

        $dsn = "mysql:host=$host;port=3307;dbname=$db;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
            echo "Connexion réussie !";
        } catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }
}
