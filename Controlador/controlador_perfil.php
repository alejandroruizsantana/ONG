<?php
// Controlador de perfil: protege la ruta, obtiene datos del usuario y prepara el perfil.
session_start();
include_once '../conexion/conexion_base_datos.php';
include_once '../Modelo/modelo_usuarios.php';
include_once '../Modelo/modelo_quedadas.php';
include_once '../Modelo/modelo_donaciones.php';

// Protección de ruta
if (!isset($_SESSION['usuario']) || !isset($_SESSION['id'])) {
    header("Location: ../vista/login.php");
    exit;
}

// Si es admin, redirigimos a su panel de administración
if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') {
    header('Location: ../Controlador/controlador_admin.php');
    exit;
}

// Obtener datos frescos del usuario
$usuario_datos = obtener_usuario_por_id($conexion, $_SESSION['id']);

if (!$usuario_datos) {
    header("Location: ../vista/login.php");
    exit;
}

// Sincronizar sesión
$_SESSION['foto_perfil'] = $usuario_datos['foto_perfil'] ?? 'avatar_default.jpg';
$_SESSION['rol'] = $usuario_datos['rol'];

// Estadísticas del usuario
$total_quedadas_pendientes = obtener_total_quedadas_pendientes_usuario($conexion, $_SESSION['id']);
$total_donado = obtener_total_donaciones_usuario($conexion, $_SESSION['id']);
$proximas_quedadas = obtener_proximas_quedadas_usuario($conexion, $_SESSION['id'], 4);

include_once '../vista/perfil_usuario.php';
exit();
