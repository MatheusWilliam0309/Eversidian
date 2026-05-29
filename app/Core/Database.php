<?php
    class Database {
        private static $instancia = null;

        // Construtor privado para evitar instanciação externa
        private function __construct() {}
        private function __clone() {}

        public static function getInstance() {
            if (self::$instancia === null) {
                try {
                    $host = 'localhost';
                    $db   = 'eversidian';
                    $user = 'root';
                    $pass = '';
                    $charset = 'utf8mb4';

                    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
                    $options = array(
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES   => false, // Previne SQL Injection
                    );
                    
                    self::$instancia = new PDO($dsn, $user, $pass, $options);
                } catch (PDOException $e) {
                    die("Falha na conexão com o Vácuo: " . $e->getMessage());
                }
            }
            return self::$instancia;
        }
    }
?>