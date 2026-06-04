<?php
session_start();
include_once '../conexion/conexion_base_datos.php';
include_once '../Modelo/modelo_usuarios.php';

// Protección de ruta
if (!isset($_SESSION['usuario']) || !isset($_SESSION['id'])) {
    header("Location: ../vista/login.php");
    exit;
}

// Si es POST, procesar guardado (puedes adaptar según tus funciones actuales)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'guardar_perfil') {
    $id = intval($_SESSION['id']);
    $usuario = trim($_POST['nuevo_usuario'] ?? '');
    $nueva_pass = trim($_POST['nueva_pass'] ?? '');
    // Aquí deberías llamar a una función del modelo para actualizar los datos y contraseña
    // Por ahora, solo guardamos un mensaje de éxito y redirigimos al perfil
    $_SESSION['mensaje_exito'] = 'Perfil actualizado correctamente (implementa guardado en controlador).';
    header('Location: ../Controlador/controlador_perfil.php');
    exit();
}

// Si es GET o no viene POST, obtener los datos para mostrar el formulario
$usuario_datos = obtener_usuario_por_id($conexion, $_SESSION['id']);
if (!$usuario_datos) {
    header("Location: ../vista/login.php");
    exit;
}

include_once '../vista/editar_usuario.php';
exit();
