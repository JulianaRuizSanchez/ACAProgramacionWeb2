<?php
// Se incluyen las clases para la conexión a la bd y al modelo
require_once 'config/database.php';
require_once 'models/Paciente.php';

class PacienteController {
    
    // Muestra la lista de los pacientes registrados
    public function index() {
        $db = (new Database())->getConnection();
        $paciente = new Paciente($db);
        $stmt = $paciente->listar();
        $pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'views/pacientes/index.php';
    }

    // Muestra el formulario de crear paciente
    public function crear() {
        require_once 'views/pacientes/crear.php';
    }
    
    // Hace el submit o procesamiento del formulario de crear paciente, insertando en la bd (en la tabla pacientes)
    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $db = (new Database())->getConnection();
            $paciente = new Paciente($db);
            
            // Usamos ?? '' para evitar errores si un campo opcional viene vacío
            $paciente->nombre_completo = $_POST['nombre_completo'] ?? '';
            $paciente->tipo_documento = $_POST['tipo_documento'] ?? '';
            $paciente->numero_documento = $_POST['numero_documento'] ?? '';
            $paciente->direccion = $_POST['direccion'] ?? '';
            $paciente->telefono = $_POST['telefono'] ?? '';
            $paciente->celular = $_POST['celular'] ?? '';
            $paciente->fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
            $paciente->edad = $_POST['edad'] ?? '';
            $paciente->eps = $_POST['eps'] ?? '';
            $paciente->contacto_adicional = $_POST['contacto_adicional'] ?? '';
            $paciente->parentesco = $_POST['parentesco'] ?? '';
            $paciente->tipo_examen = $_POST['tipo_examen'] ?? '';
            $paciente->empresa_solicita = $_POST['empresa_solicita'] ?? '';
            $paciente->fecha_examen = $_POST['fecha_examen'] ?? '';
            $paciente->doctor = $_POST['doctor'] ?? '';
            $paciente->hora_examen = $_POST['hora_examen'] ?? '';
            
            // Si el paciente se guarda correctamente se redirige al listado, si no muestra un mensaje de error
            if($paciente->registrar()) {
                header("Location: ?controller=paciente&action=index");
            } else {
                echo "Error al guardar el paciente.";
            }
        }
    }

    // Muestra el formulario de editar paciente y carga los datos registrados del paciente seleccionado, si no entonces redirige al listado
    public function editar() {
        if (isset($_GET['id'])) {
            $db = (new Database())->getConnection();
            $pacienteModel = new Paciente($db);
            $paciente = $pacienteModel->obtenerPorId($_GET['id']);
            require_once 'views/pacientes/editar.php';
        } else {
            header("Location: ?controller=paciente&action=index");
        }
    }

    // Hace el submit o procesamiento del formulario de editar paciente, actualizando en la bd (en la tabla pacientes)
    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
            $db = (new Database())->getConnection();
            $pacienteObj = new Paciente($db);
            
            $pacienteObj->nombre_completo = $_POST['nombre_completo'] ?? '';
            $pacienteObj->tipo_documento = $_POST['tipo_documento'] ?? '';
            $pacienteObj->numero_documento = $_POST['numero_documento'] ?? '';
            $pacienteObj->direccion = $_POST['direccion'] ?? '';
            $pacienteObj->telefono = $_POST['telefono'] ?? '';
            $pacienteObj->celular = $_POST['celular'] ?? '';
            $pacienteObj->fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
            $pacienteObj->edad = $_POST['edad'] ?? '';
            $pacienteObj->eps = $_POST['eps'] ?? '';
            $pacienteObj->contacto_adicional = $_POST['contacto_adicional'] ?? '';
            $pacienteObj->parentesco = $_POST['parentesco'] ?? '';
            $pacienteObj->tipo_examen = $_POST['tipo_examen'] ?? '';
            $pacienteObj->empresa_solicita = $_POST['empresa_solicita'] ?? '';
            $pacienteObj->fecha_examen = $_POST['fecha_examen'] ?? '';
            $pacienteObj->doctor = $_POST['doctor'] ?? '';
            $pacienteObj->hora_examen = $_POST['hora_examen'] ?? '';
            
            // Si el paciente se actualiza correctamente se redirige al listado, si no muestra un mensaje de error
            if($pacienteObj->actualizar($_POST['id'])) {
                header("Location: ?controller=paciente&action=index");
            } else {
                echo "Error al actualizar.";
            }
        }
    }

    // Elimina el registro de un paciente y recarga el listado, si no muestra un mensaje de error
    public function eliminar() {
        if (isset($_GET['id'])) {
            $db = (new Database())->getConnection();
            $paciente = new Paciente($db);
            if($paciente->eliminar($_GET['id'])) {
                header("Location: ?controller=paciente&action=index");
            } else {
                echo "Error al eliminar el paciente.";
            }
        } else {
            header("Location: ?controller=paciente&action=index");
        }
    }

    // Cambia el estado del paciente (HECHO o ANULADO) y recarga el lsitado, si no muestra un mensaje de error
    public function cambiar_estado() {
        if (isset($_GET['id']) && isset($_GET['estado'])) {
            $db = (new Database())->getConnection();
            $paciente = new Paciente($db);
            if($paciente->cambiarEstado($_GET['id'], $_GET['estado'])) {
                header("Location: ?controller=paciente&action=index");
            } else {
                echo "Error al cambiar el estado.";
            }
        }
    }

    // Consulta la tabla de pacientes para ver si el paciente tiene un examen pendiente del mismo tipo de examen y 
    // también consulta hace otra consulta para obtener las horas ocupadas del doctor seleccionado en la fecha seleccionada,
    // luego devuelve un JSON para que el front pueda mostrar un mensaje de alerta si el paciente ya tiene este examen pendiente,
    // mostrar las horas disponibles y los días
    public function consultar_agenda() {
        $db = (new Database())->getConnection();
        $paciente = new Paciente($db);
        $respuesta = ['tiene_pendiente' => false, 'horas_ocupadas' => []];

        if(isset($_GET['tipo_doc']) && isset($_GET['num_doc']) && isset($_GET['tipo_examen'])) {
            $id_actual = isset($_GET['id_actual']) ? $_GET['id_actual'] : null;
            $respuesta['tiene_pendiente'] = $paciente->validarExamenPendiente($_GET['tipo_doc'], $_GET['num_doc'], $_GET['tipo_examen'], $id_actual);
        }

        if(isset($_GET['fecha']) && isset($_GET['doctor'])) {
            $respuesta['horas_ocupadas'] = $paciente->obtenerHorasOcupadas($_GET['fecha'], $_GET['doctor']);
        }

        header('Content-Type: application/json');
        echo json_encode($respuesta);
        exit();
    }
}
?>