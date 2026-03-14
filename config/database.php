<?php

class Database {
    // Credenciales por defecto del localhost
    private $host = "localhost";
    private $db_name = "ips_alma_vida";
    private $username = "root";
    private $password = "";
    public $conn;

    // Método para obtener la conexión a la bd
    public function getConnection() {
        $this->conn = null;

        try {
            // Se intenta conectar usando PDO
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            
            // Se configura para que soporte caracteres especiales (como tildes o la letra ñ)
            $this->conn->exec("set names utf8");
            
            // Se configura para que muestre los errores si algo falla
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch(PDOException $exception) {
            // Si algo sale mal, se muestra el error
            echo "Error de conexión a la base de datos: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>