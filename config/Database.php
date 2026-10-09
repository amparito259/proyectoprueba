<?php
class Database {
    private $host = "localhost";
    private $db_name = "proyectoprueba";
    private $username = "root";
    private $password = "";
    public $conexion;

    public function getConnection() {
        $this->conexion = null;
        try {
            $this->conexion = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $exception) {
            echo "Error de conexión a la base de datos: " . $exception->getMessage();
        }
        return $this->conexion;
    }
}