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

    // eliminamos físicamente la quedada y sus inscripciones de la base de datos
    if (isset($_POST['accion']) && $_POST['accion'] === 'borrar_quedada' && isset($_POST['id_quedada'])) {
        $id = intval($_POST['id_quedada']);
        // primero borramos las inscripciones para no dejar registros huérfanos
        $borradoInscritos = eliminar_inscripciones_quedada($conexion, $id);
        // luego eliminamos físicamente la quedada
        $borradoQuedada = eliminar_quedada($conexion, $id);

        if ($borradoQuedada) {
            $_SESSION['mensaje_exito'] = "Quedada eliminada con éxito.";
        } else {
            $_SESSION['mensaje_error'] = "No se pudo eliminar la quedada.";
        }

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

    // eliminamos el usuario, decrementamos sus plazas ocupadas y borramos sus inscripciones
    if (isset($_POST['accion']) && $_POST['accion'] === 'eliminar_usuario' && isset($_POST['id_usuario'])) {
        $id = intval($_POST['id_usuario']);

        // comprobamos si el usuario tiene donaciones antes de eliminarlo
        $donaciones = mysqli_query($conexion, "SELECT COUNT(*) AS total FROM donaciones WHERE id_usuario = $id");
        $fila = mysqli_fetch_assoc($donaciones);
        if ($fila['total'] > 0) {
            $_SESSION['mensaje_error'] = "No se puede eliminar este usuario porque tiene donaciones registradas.";
            $_SESSION['activeTab'] = 'usuarios';
            header("Location: controlador_admin.php");
            exit();
        }

        // decrementamos las plazas de cada quedada en la que estaba inscrito
        $inscripciones = mysqli_query($conexion, "SELECT id_quedada FROM inscripciones WHERE id_usuario = $id");
        if ($inscripciones) {
            while ($fila = mysqli_fetch_assoc($inscripciones)) {
                decrementar_plazas_ocupadas($conexion, $fila['id_quedada']);
            }
        }

        // eliminamos las inscripciones y el usuario de la base de datos
        $borradoInscripciones = eliminar_inscripciones_usuario($conexion, $id);
        $borradoUsuario = eliminar_usuario($conexion, $id);

        if ($borradoUsuario) {
            $_SESSION['mensaje_exito'] = "Usuario eliminado con éxito.";
        } else {
            $_SESSION['mensaje_error'] = "No se pudo eliminar el usuario.";
        }

        $_SESSION['activeTab'] = 'usuarios';
        header("Location: controlador_admin.php");
        exit();
    }
    

    // guardamos los cambios del formulario de edición en la base de datos
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

        $_SESSION['activeTab'] = 'usuarios';
        header("Location: controlador_admin.php");
        exit();
    }
}

// pestaña activa por defecto: quedadas
$activeTab = 'quedadas';
if (isset($_SESSION['activeTab'])) {
    // Si ya había una pestaña guardada en sesión, la usamos
    $activeTab = $_SESSION['activeTab'];
}

// si el valor no es válido forzamos quedadas
if ($activeTab !== 'usuarios' && $activeTab !== 'quedadas') {
    $activeTab = 'quedadas';
}

// cargamos los datos de quedadas y usuarios para la vista
$resultadoAdmin = obtener_quedadas_admin($conexion);
$usuariosAdmin = obtener_todos_usuarios($conexion);

// obtenemos los totales para las estadísticas del panel
$estadisticas = obtener_estadisticas_admin($conexion);
$totalQuedadasCount  = $estadisticas['total_quedadas'];
$totalUsuariosCount  = $estadisticas['total_usuarios'];
$totalPlazasOcupadas = $estadisticas['total_plazas_ocupadas'];

// reiniciamos el puntero del resultado para que la vista pueda recorrerlo desde el inicio
if ($resultadoAdmin) {
    mysqli_data_seek($resultadoAdmin, 0);
}

// cargamos la vista del panel con todos los datos preparados
include_once '../vista/admin_panel.php';
exit();