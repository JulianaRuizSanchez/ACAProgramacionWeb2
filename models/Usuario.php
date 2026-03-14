<?php
class Usuario {
    // Atributos de la clase Usuario (conexión a la bd y nombre de la tabla)
    private $conn;
    private $table_name = "usuarios";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Función para autenticar al usuario (verificar correo y contraseña)
    public function autenticar($correo, $password) {
        $query = "SELECT id, nombre, password FROM " . $this->table_name . " WHERE correo = :correo LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":correo", $correo);
        $stmt->execute();

        if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // se verifica si la clave coincide
            if($password === $row['password']) {
                return $row; // Devuelve los datos del usuario si es correcto
            }
        }
        return false; // Devuelve falso si el correo no existe o la clave está mal
    }
}
?>