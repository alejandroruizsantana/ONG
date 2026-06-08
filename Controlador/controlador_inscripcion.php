<?php
// Iniciamos la sesion
session_start();

// incluimos la conexión y el modelo de quedadas
include_once '../conexion/conexion_base_datos.php'; 
include_once '../Modelo/modelo_quedadas.php'; 

// solo procesamos si el formulario llega por POST con el id de la quedada
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_quedada'])) {
    
    // si no hay sesión activa redirigimos al login
    if (!isset($_SESSION['id'])) {
        header("Location: ../vista/login.php");
        exit();
    }

    // recogemos el id de la quedada y el id del usuario de la sesión
    $id_quedada = intval($_POST['id_quedada']);
    $id_usuario = $_SESSION['id'];

    // si no viene acción en el POST asumimos que quiere apuntarse
    $accion = $_POST['accion'] ?? 'apuntar';

    // si la acción es 'quitar' damos de baja al usuario de la quedada
    if ($accion === 'quitar') {
        $exito = eliminar_inscripcion_usuario($conexion, $id_usuario, $id_quedada);
        if ($exito) {
            // restamos una plaza ocupada en la quedada
            decrementar_plazas_ocupadas($conexion, $id_quedada);
            $_SESSION['mensaje_exito'] = "Te has dado de baja de la quedada.";
        } else {
            $_SESSION['mensaje_error'] = "No se pudo procesar la baja. Inténtalo de nuevo.";
        }
        header("Location: ../vista/quedadas.php");
        exit();
    }

    // acción por defecto: intentamos inscribir al usuario en la quedada
    $resultado_registro = insertar_inscripcion_usuario($conexion, $id_usuario, $id_quedada);

    if ($resultado_registro === true) {
        // inscripción correcta: sumamos una plaza ocupada y mostramos éxito
        incrementar_plazas_ocupadas($conexion, $id_quedada);
        $_SESSION['mensaje_exito'] = "¡Te has inscrito correctamente!";
        header("Location: ../vista/quedadas.php");
        exit();
    } elseif ($resultado_registro === 'duplicado') {
        // el modelo detectó que ya existe esa inscripción en la bd
        $_SESSION['mensaje_error'] = "¡Ya estás inscrito en esta quedada!";
        header("Location: ../vista/quedadas.php");
        exit();
    } else {
        // error inesperado al insertar
        $_SESSION['mensaje_error'] = "Hubo un problema al tramitar tu inscripción. Inténtalo de nuevo.";
        header("Location: ../vista/quedadas.php");
        exit();
    }
}
?>