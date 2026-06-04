<?php
session_start();
include_once '../conexion/conexion_base_datos.php';
include_once '../Modelo/modelo_usuarios.php';

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

include_once '../vista/perfil_usuario.php';
exit();
