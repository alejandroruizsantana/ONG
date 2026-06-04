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



    $id_quedada = intval($_POST['id_quedada']); 
    $id_usuario = $_SESSION['id'];             

//Usamos la funcion del modelo para insertar un usuarios en las inscripciones  

$resultado_registro = insertar_inscripcion_usuario($conexion, $id_usuario, $id_quedada);

//Si está todo bien incrementamos una plaza

if ($resultado_registro === true) {
    incrementar_plazas_ocupadas($conexion, $id_quedada);
    
    // Guardamos mensaje de éxito en la sesión
    $_SESSION['mensaje_exito'] = "¡Te has inscrito correctamente!";
    
    header("Location: ../vista/quedadas.php");
    exit();
} 
//Si devuelve 'duplicado' mostramos un error de que ya esta inscrito en la quedada
elseif ($resultado_registro === 'duplicado') {
    // Guardamos el error de duplicado en la sesión
    $_SESSION['mensaje_error'] = "¡Ya estás inscrito en esta quedada! ";
    
    header("Location: ../vista/quedadas.php");
    exit();
} 
//Si da otro error que no sea de duplicado mostramos otro mensaje de error
else {
    // Guardamos el error general en la sesión
    $_SESSION['mensaje_error'] = "Hubo un problema al tramitar tu inscripción. Inténtalo de nuevo.";
    
    header("Location: ../vista/quedadas.php");
    exit();
}
    }
?>