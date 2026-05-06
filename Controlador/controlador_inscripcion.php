<?php
// Iniciamos sesion
session_start();

// Incluimos la conexión a la base de datos y al modelo
include_once '../conexion/conexion_base_datos.php'; 
include_once '../Modelo/modelo_quedadas.php'; 

// Verificamos que los datos llegan por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_quedada'])) {
    
    // Si no a iniciado sesion al login
    if (!isset($_SESSION['id'])) {
        header("Location: ../vista/login.php");
        exit();
    }

   // ... Tu código anterior de seguridad del controlador (POST, sesiones, etc.) ...

    $id_quedada = intval($_POST['id_quedada']); 
    $id_usuario = $_SESSION['id'];             

    // ... Tu código de seguridad, POST e IDs igual que antes ...

$resultado_registro = insertar_inscripcion_usuario($conexion, $id_usuario, $id_quedada);

if ($resultado_registro === true) {
    incrementar_plazas_ocupadas($conexion, $id_quedada);
    
    // Guardamos mensaje de éxito en la sesión
    $_SESSION['mensaje_exito'] = "¡Te has inscrito correctamente!";
    
    header("Location: ../vista/quedadas.php");
    exit();
} 
elseif ($resultado_registro === 'duplicado') {
    // Guardamos el error de duplicado en la sesión
    $_SESSION['mensaje_error'] = "¡Ya estás inscrito en esta quedada! ";
    
    header("Location: ../vista/quedadas.php");
    exit();
} 
else {
    // Guardamos un error general en la sesión
    $_SESSION['mensaje_error'] = "Hubo un problema al tramitar tu inscripción. Inténtalo de nuevo.";
    
    header("Location: ../vista/quedadas.php");
    exit();
}
    }
?>