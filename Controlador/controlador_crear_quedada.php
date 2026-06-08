<?php
// Controlador de creación de quedada. Procesa el formulario y guarda la nueva quedada.
session_start();
include_once '../conexion/conexion_base_datos.php';
include_once '../Modelo/modelo_quedadas.php';

// Solo admin
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../vista/login.php");
    exit();
}

// Si es GET, mostrar formulario
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    include_once '../vista/crear_quedada.php';
    exit();
}

// Si es POST, procesar creación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $fecha = trim($_POST['fecha'] ?? '');
    $hora_inicio = trim($_POST['hora_inicio'] ?? '');
    $hora_fin = trim($_POST['hora_fin'] ?? '');
    $ubicacion = trim($_POST['ubicacion'] ?? '');
    $provincia = trim($_POST['provincia'] ?? '');
    $plazas_totales = intval($_POST['plazas_totales'] ?? 0);

    // Validaciones básicas
    $errores = [];
    if (empty($titulo)) $errores[] = "El título es obligatorio.";
    if (empty($fecha)) $errores[] = "La fecha es obligatoria.";
    if (empty($hora_inicio)) $errores[] = "La hora de inicio es obligatoria.";
    if (empty($hora_fin)) $errores[] = "La hora de fin es obligatoria.";
    if (empty($ubicacion)) $errores[] = "La ubicación es obligatoria.";
    if ($plazas_totales <= 0) $errores[] = "Las plazas totales deben ser mayores a 0.";

    if (!empty($errores)) {
        $_SESSION['errores_creacion'] = $errores;
        header("Location: ../Controlador/controlador_crear_quedada.php");
        exit();
    }

    // Insertar la quedada con estado 'disponible'
    $exito = insertar_quedada($conexion, $titulo, $descripcion, $fecha, $hora_inicio, $hora_fin, $ubicacion, $provincia, $plazas_totales, 'disponible');

    if ($exito) {
        $_SESSION['mensaje_exito'] = "Quedada creada correctamente.";
        $_SESSION['activeTab'] = 'quedadas';
        header("Location: ../Controlador/controlador_admin.php");
        exit();
    } else {
        $_SESSION['mensaje_error'] = "No se pudo crear la quedada.";
        header("Location: ../Controlador/controlador_crear_quedada.php");
        exit();
    }
}
