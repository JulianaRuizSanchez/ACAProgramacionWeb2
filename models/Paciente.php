<?php

// Aquí definimos la clase Paciente, que se encargará de manejar toda la lógica relacionada con los pacientes en la aplicación.
class Paciente {
    // Propiedades para la conexión a la base de datos y el nombre de la tabla
    private $conn;
    private $table_name = "pacientes";

    // Propiedades del objeto (los datos que pide la IPS) 
    public $nombre_completo;
    public $tipo_documento;
    public $numero_documento;
    public $direccion;
    public $telefono;
    public $celular;
    public $fecha_nacimiento;
    public $edad;
    public $eps;
    public $contacto_adicional;
    public $parentesco;
    public $tipo_examen;
    public $empresa_solicita;
    public $fecha_examen;
    public $doctor;
    public $hora_examen;
    public $estado;

    // Constructor que recibe la conexión a la base de datos
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para listar todos los pacientes
    public function listar() {
        // Seleccionamos todo y lo ordenamos por los más recientes
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY fecha_registro DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }

    // Método para registrar un nuevo paciente en la base de datos
    public function registrar() {
        $query = "INSERT INTO " . $this->table_name . " 
                  (nombre_completo, tipo_documento, numero_documento, direccion, telefono, celular, fecha_nacimiento, edad, eps, contacto_adicional, parentesco, tipo_examen, empresa_solicita, fecha_examen, doctor, hora_examen, estado) 
                  VALUES 
                  (:nombre_completo, :tipo_documento, :numero_documento, :direccion, :telefono, :celular, :fecha_nacimiento, :edad, :eps, :contacto_adicional, :parentesco, :tipo_examen, :empresa_solicita, :fecha_examen, :doctor, :hora_examen, 'Pendiente')";

        $stmt = $this->conn->prepare($query);

        // Bind de los datos normales
        $stmt->bindParam(":nombre_completo", $this->nombre_completo);
        $stmt->bindParam(":tipo_documento", $this->tipo_documento);
        $stmt->bindParam(":numero_documento", $this->numero_documento);
        $stmt->bindParam(":direccion", $this->direccion);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":celular", $this->celular);
        $stmt->bindParam(":fecha_nacimiento", $this->fecha_nacimiento);
        $stmt->bindParam(":edad", $this->edad);
        $stmt->bindParam(":eps", $this->eps);
        $stmt->bindParam(":contacto_adicional", $this->contacto_adicional);
        $stmt->bindParam(":parentesco", $this->parentesco);
        $stmt->bindParam(":tipo_examen", $this->tipo_examen);
        $stmt->bindParam(":empresa_solicita", $this->empresa_solicita);
        $stmt->bindParam(":fecha_examen", $this->fecha_examen);
        $stmt->bindParam(":doctor", $this->doctor);
        $stmt->bindParam(":hora_examen", $this->hora_examen);

        return $stmt->execute();
    }

    // Método para consultar un solo paciente por su ID
    public function obtenerPorId($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        // Retornamos el registro como un arreglo asociativo
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para actualizar un paciente
    public function actualizar($id) {
        $query = "UPDATE " . $this->table_name . " SET 
                  nombre_completo = :nombre_completo, tipo_documento = :tipo_documento, numero_documento = :numero_documento, 
                  direccion = :direccion, telefono = :telefono, celular = :celular, fecha_nacimiento = :fecha_nacimiento, 
                  edad = :edad, eps = :eps, contacto_adicional = :contacto_adicional, parentesco = :parentesco, 
                  tipo_examen = :tipo_examen, empresa_solicita = :empresa_solicita, fecha_examen = :fecha_examen, doctor = :doctor, hora_examen = :hora_examen
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Declaramos los valores
        $stmt->bindParam(":nombre_completo", $this->nombre_completo);
        $stmt->bindParam(":tipo_documento", $this->tipo_documento);
        $stmt->bindParam(":numero_documento", $this->numero_documento);
        $stmt->bindParam(":direccion", $this->direccion);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":celular", $this->celular);
        $stmt->bindParam(":fecha_nacimiento", $this->fecha_nacimiento);
        $stmt->bindParam(":edad", $this->edad);
        $stmt->bindParam(":eps", $this->eps);
        $stmt->bindParam(":contacto_adicional", $this->contacto_adicional);
        $stmt->bindParam(":parentesco", $this->parentesco);
        $stmt->bindParam(":tipo_examen", $this->tipo_examen);
        $stmt->bindParam(":empresa_solicita", $this->empresa_solicita);
        $stmt->bindParam(":fecha_examen", $this->fecha_examen);
        $stmt->bindParam(":doctor", $this->doctor);
        $stmt->bindParam(":hora_examen", $this->hora_examen);
        $stmt->bindParam(":id", $id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para eliminar un paciente
    public function eliminar($id) {

        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        // Limpiamos el ID por seguridad (evita inyección SQL)
        $id = htmlspecialchars(strip_tags($id));
        $stmt->bindParam(":id", $id);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para cambiar el estado (Anular o Marcar como Hecho)
    public function cambiarEstado($id, $nuevo_estado) {
        $query = "UPDATE " . $this->table_name . " SET estado = :estado WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':estado', $nuevo_estado);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Verifica si ya hay un examen del mismo tipo pendiente (ignorando el actual si se está editando)
    public function validarExamenPendiente($tipo_doc, $num_doc, $tipo_examen, $id_actual = null) {
        $query = "SELECT id FROM " . $this->table_name . " WHERE tipo_documento = ? AND numero_documento = ? AND tipo_examen = ? AND estado = 'Pendiente'";
        $params = [$tipo_doc, $num_doc, $tipo_examen];
        
        // Si pasan un ID, se le dice a la base de datos que no cuente ese registro
        if ($id_actual) {
            $query .= " AND id != ?";
            $params[] = $id_actual;
        }
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->rowCount() > 0;
    }

    // Trae las horas ocupadas de un doctor en una fecha específica
    public function obtenerHorasOcupadas($fecha, $doctor) {
        $query = "SELECT hora_examen FROM " . $this->table_name . " WHERE fecha_examen = ? AND doctor = ? AND estado != 'Anulado'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$fecha, $doctor]);
        
        $horas = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Se guarda solo la hora (ej. '13:00')
            $horas[] = date('H:i', strtotime($row['hora_examen'])); 
        }
        return $horas;
    }
}
?>