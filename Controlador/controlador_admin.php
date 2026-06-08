<?php


// Iniciamos la sesión para poder leer y escribir variables de sesión
session_start();

// Incluimos la conexión a la base de datos y los modelos que vamos a necesitar
include_once '../conexion/conexion_base_datos.php';
include_once '../Modelo/modelo_quedadas.php';
include_once '../Modelo/modelo_usuarios.php';
include_once '../Modelo/modelo_admin.php';

// Comprobamos que hay una sesión activa y que el usuario tiene rol 'admin'.
// Si no es así, lo mandamos al login y paramos la ejecución con exit().
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../vista/login.php");
    exit();
}

// Solo procesamos acciones si el formulario se ha enviado por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    
    // Cuando el admin pulsa una pestaña (quedadas / usuarios),
    // guardamos cuál está activa en sesión y recargamos el controlador.
    if (isset($_POST['tab'])) {
        $_SESSION['activeTab'] = $_POST['tab'];
        header("Location: controlador_admin.php");
        exit();
    }
    
    
    // Comprobamos que la acción es 'borrar_quedada' y que nos llega el id de la quedada.
    if (isset($_POST['accion']) && $_POST['accion'] === 'borrar_quedada' && isset($_POST['id_quedada'])) {
        // Convertimos el id a entero para evitar inyecciones
        $id = intval($_POST['id_quedada']);
        // Primero borramos todas las inscripciones de esa quedada
        $borradoInscritos = eliminar_inscripciones_quedada($conexion, $id);
        // Luego cambiamos el estado de la quedada a 'archivada' 
        $archivoQuedada = cambiar_estado_quedada($conexion, $id, 'archivada');

        // Guardamos en sesión el mensaje de éxito o error para mostrarlo en la vista
        if ($archivoQuedada) {
            $_SESSION['mensaje_exito'] = "Quedada eliminada con éxito.";
        } else {
            $_SESSION['mensaje_error'] = "No se pudo eliminar la quedada.";
        }

        // Volvemos al panel en la pestaña de quedadas
        $_SESSION['activeTab'] = 'quedadas';
        header("Location: controlador_admin.php");
        exit();
    }

    
    // Cuando el admin pulsa "Editar" en un usuario, buscamos sus datos en la BD
    // y cargamos la vista del formulario de edición.
    if (isset($_POST['accion']) && $_POST['accion'] === 'editar_usuario' && isset($_POST['id_usuario'])) {
        $id = intval($_POST['id_usuario']);
        // Obtenemos los datos actuales del usuario desde el modelo
        $usuarioDatos = obtener_usuario_por_id($conexion, $id);
        // Si no existe el usuario, mostramos error y volvemos al panel
        if (!$usuarioDatos) {
            $_SESSION['mensaje_error'] = "Usuario no encontrado.";
            $_SESSION['activeTab'] = 'usuarios';
            header("Location: controlador_admin.php");
            exit();
        }

        // Si el usuario existe, cargamos la vista del formulario de edición y paramos
        include_once '../vista/admin_editar_usuario.php';
        exit();
    }

  
    if (isset($_POST['accion']) && $_POST['accion'] === 'eliminar_usuario' && isset($_POST['id_usuario'])) {
        $id = intval($_POST['id_usuario']);
        // Primero eliminamos todas las inscripciones del usuario (para no dejar huérfanos)
        $borradoInscripciones = eliminar_inscripciones_usuario($conexion, $id);
        // Luego eliminamos el usuario de la base de datos
        $borradoUsuario = eliminar_usuario($conexion, $id);

        if ($borradoUsuario) {
            $_SESSION['mensaje_exito'] = "Usuario eliminado con éxito.";
        } else {
            $_SESSION['mensaje_error'] = "No se pudo eliminar el usuario.";
        }

        // Volvemos al panel en la pestaña de usuarios
        $_SESSION['activeTab'] = 'usuarios';
        header("Location: controlador_admin.php");
        exit();
    }

   
    if (isset($_POST['accion']) && $_POST['accion'] === 'guardar_usuario' && isset($_POST['id_usuario'])) {
        $id = intval($_POST['id_usuario']);
        // Recogemos los nuevos datos del formulario y les quitamos espacios con trim()
        $usuario = trim($_POST['usuario'] ?? '');
        $email = trim($_POST['email'] ?? '');
        // Si no viene el rol, por defecto lo dejamos como 'usuario'
        $rol = trim($_POST['rol'] ?? 'usuario');

        // Llamamos al modelo para actualizar los datos en la BD
        $actualizado = actualizar_usuario_admin($conexion, $id, $usuario, $email, $rol);
        if ($actualizado) {
            $_SESSION['mensaje_exito'] = "Usuario actualizado correctamente.";
        } else {
            $_SESSION['mensaje_error'] = "No se pudo actualizar el usuario.";
        }

        // Volvemos al panel en la pestaña de usuarios
        $_SESSION['activeTab'] = 'usuarios';
        header("Location: controlador_admin.php");
        exit();
    }
}

// Preparamos los datos para usarlos en la vista

// Por defecto mostramos la pestaña de quedadas
$activeTab = 'quedadas';
if (isset($_SESSION['activeTab'])) {
    // Si ya había una pestaña guardada en sesión, la usamos
    $activeTab = $_SESSION['activeTab'];
    
}

// Validación extra: si el valor de activeTab no es uno de los dos permitidos, forzamos 'quedadas'
if ($activeTab !== 'usuarios' && $activeTab !== 'quedadas') {
    $activeTab = 'quedadas';
}

// Cargamos los datos de ambas pestañas para que la vista los tenga disponibles
$resultadoAdmin = obtener_quedadas_admin($conexion);   // Lista de todas las quedadas (incluidas archivadas)
$usuariosAdmin = obtener_todos_usuarios($conexion);    // Lista de todos los usuarios registrados

// Obtenemos las estadísticas del panel (totales de quedadas, usuarios y plazas ocupadas)
$estadisticas = obtener_estadisticas_admin($conexion);
$totalQuedadasCount  = $estadisticas['total_quedadas'];
$totalUsuariosCount  = $estadisticas['total_usuarios'];
$totalPlazasOcupadas = $estadisticas['total_plazas_ocupadas'];

// Cargamos la vista del panel de administración con todos los datos ya preparados
include_once '../vista/admin_panel.php';
exit();