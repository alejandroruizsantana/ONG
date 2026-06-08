<?php
// Controlador de edición de quedada: carga datos de la quedada y actualiza en la base de datos.
session_start();
// Conexión y modelo de quedadas para operaciones de consulta y actualización.
include_once '../conexion/conexion_base_datos.php';
include_once '../Modelo/modelo_quedadas.php';

// Seguridad: solo usuarios admin pueden editar quedadas.
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../vista/login.php");
    exit();
}

// Si viene por GET, cargamos los datos de la quedada y mostramos el formulario con valores actuales.
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = intval($_GET['id'] ?? 0);
    if ($id <= 0) {
        $_SESSION['mensaje_error'] = "Quedada no encontrada.";
        header("Location: controlador_admin.php");
        exit();
    }

    $quedada = obtener_quedada_por_id($conexion, $id);
    if (!$quedada) {
        $_SESSION['mensaje_error'] = "Quedada no encontrada.";
        header("Location: controlador_admin.php");
        exit();
    }

    include_once '../vista/editar_quedada.php';
    exit();
}

// Si viene por POST, procesamos los datos del formulario para actualizar la quedada.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id_quedada'] ?? 0);
    $titulo = trim($_POST['titulo'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $fecha = trim($_POST['fecha'] ?? '');
    $hora_inicio = trim($_POST['hora_inicio'] ?? '');
    $hora_fin = trim($_POST['hora_fin'] ?? '');
    $ubicacion = trim($_POST['ubicacion'] ?? '');
    $provincia = trim($_POST['provincia'] ?? '');
    $plazas_totales = intval($_POST['plazas_totales'] ?? 0);

    // Validaciones básicas para asegurarnos de que los campos obligatorios están completos.
    $errores = [];
    if ($id <= 0) {
        $errores[] = "Quedada no válida.";
    }
    if (empty($titulo)) {
        $errores[] = "El título es obligatorio.";
    }
    if (empty($fecha)) {
        $errores[] = "La fecha es obligatoria.";
    }
    if (empty($hora_inicio)) {
        $errores[] = "La hora de inicio es obligatoria.";
    }
    if (empty($hora_fin)) {
        $errores[] = "La hora de fin es obligatoria.";
    }
    if (empty($ubicacion)) {
        $errores[] = "La ubicación es obligatoria.";
    }
    if ($plazas_totales <= 0) {
        $errores[] = "Las plazas totales deben ser mayores a 0.";
    }

    $quedada = [
        'id' => $id,
        'titulo' => $titulo,
        'descripcion' => $descripcion,
        'fecha' => $fecha,
        'hora_inicio' => $hora_inicio,
        'hora_fin' => $hora_fin,
        'ubicacion' => $ubicacion,
        'provincia' => $provincia,
        'plazas_totales' => $plazas_totales,
    ];

    if (!empty($errores)) {
        include_once '../vista/editar_quedada.php';
        exit();
    }

    $exito = actualizar_quedada($conexion, $id, $titulo, $descripcion, $fecha, $hora_inicio, $hora_fin, $ubicacion, $provincia, $plazas_totales);
    if ($exito) {
        $_SESSION['mensaje_exito'] = "Quedada actualizada correctamente.";
        $_SESSION['activeTab'] = 'quedadas';
        header("Location: controlador_admin.php");
        exit();
    }

    $errores[] = "No se pudo actualizar la quedada.";
    include_once '../vista/editar_quedada.php';
    exit();
}
?>