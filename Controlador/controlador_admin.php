<?php
session_start();
include_once '../conexion/conexion_base_datos.php';
include_once '../Modelo/modelo_quedadas.php';
include_once '../Modelo/modelo_usuarios.php';

// Seguridad: Solo admin
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../vista/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['accion']) && $_POST['accion'] === 'borrar_quedada' && isset($_POST['id_quedada'])) {
        $id = intval($_POST['id_quedada']);
        $borradoInscritos = eliminar_inscripciones_quedada($conexion, $id);
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

    // Preparar vista de edición: obtener usuario y mostrar formulario de edición
    if (isset($_POST['accion']) && $_POST['accion'] === 'editar_usuario' && isset($_POST['id_usuario'])) {
        $id = intval($_POST['id_usuario']);
        $usuarioDatos = obtener_usuario_por_id($conexion, $id);
        if (!$usuarioDatos) {
            $_SESSION['mensaje_error'] = "Usuario no encontrado.";
            $_SESSION['activeTab'] = 'usuarios';
            header("Location: controlador_admin.php");
            exit();
        }

        include_once '../vista/admin_editar_usuario.php';
        exit();
    }

    if (isset($_POST['accion']) && $_POST['accion'] === 'eliminar_usuario' && isset($_POST['id_usuario'])) {
        $id = intval($_POST['id_usuario']);
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

    if (isset($_POST['accion']) && $_POST['accion'] === 'guardar_usuario' && isset($_POST['id_usuario'])) {
        $id = intval($_POST['id_usuario']);
        $usuario = trim($_POST['usuario'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $rol = trim($_POST['rol'] ?? 'usuario');

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

// Preparar datos y mostrar la vista (usa POST['tab'] o $_SESSION['activeTab'] para seleccionar pestaña)
$activeTab = 'quedadas';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tab'])) {
    $activeTab = $_POST['tab'];
} elseif (isset($_SESSION['activeTab'])) {
    $activeTab = $_SESSION['activeTab'];
    unset($_SESSION['activeTab']);
}
if ($activeTab !== 'usuarios' && $activeTab !== 'quedadas') {
    $activeTab = 'quedadas';
}

// Datos para la vista
$resultadoAdmin = obtener_quedadas_admin($conexion);
$usuariosAdmin = null;
if ($activeTab === 'usuarios') {
    $usuariosAdmin = obtener_todos_usuarios($conexion);
}

$estadisticas = obtener_estadisticas_admin($conexion);
$totalQuedadasCount = $estadisticas['total_quedadas'];
$totalUsuariosCount = $estadisticas['total_usuarios'];
$totalPlazasOcupadas = $estadisticas['total_plazas_ocupadas'];

include_once '../vista/admin_panel.php';
exit();