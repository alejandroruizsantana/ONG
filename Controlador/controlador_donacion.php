<?php
// Controlador de donación: recibe el pago simulado y guarda la donación en la base de datos.
session_start();
// Incluimos la conexión y el modelo de donaciones para guardar los aportes.
include_once '../conexion/conexion_base_datos.php';
include_once '../Modelo/modelo_donaciones.php';

// Solo aceptamos envíos por POST desde el formulario de donación.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../vista/donaciones.php');
    exit();
}

// Recogemos los datos que han enviado desde el formulario de donación.
$cantidad = intval($_POST['cantidad'] ?? 0);
$metodo_pago = trim($_POST['metodo_pago'] ?? 'tarjeta');
$nombre = trim($_POST['nombre'] ?? 'Anonimo');
$email = trim($_POST['email'] ?? '');

// Validación mínima de importe.
if ($cantidad <= 0) {
    $_SESSION['mensaje_error'] = 'Introduce una cantidad válida para donar.';
    header('Location: ../vista/donaciones.php');
    exit();
}

// Asociamos la donación al usuario si está autenticado.
$id_usuario = isset($_SESSION['id']) ? intval($_SESSION['id']) : null;

// Guardamos la donación en la base de datos.
$exito = insertar_donacion($conexion, $id_usuario, $nombre, $email, $cantidad, $metodo_pago);

if ($exito) {
    $_SESSION['mensaje_exito'] = 'Tu donación se ha procesado correctamente. Gracias por apoyar al lince.';
    header('Location: ../vista/recompensas.php');
    exit();
}

$_SESSION['mensaje_error'] = 'No se pudo procesar la donación. Intenta de nuevo más tarde.';
header('Location: ../vista/donaciones.php');
exit();
?>