<?php
require_once '../modelo/modelo_usuarios.php';
session_start();
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $login_correcto=false;

    $datos = [
        'usuario' => sanear($_POST['usuario']),
        'email' => sanear($_POST['email']),
        'contraseña' => sanear($_POST['contraseña']),
    ];

    // Validamos
    $errores = validar($datos);

   $errores = validar($datos);

// Comprobar si hay errores reales
$hayErrores = false;
foreach ($errores as $campo => $listaErrores) {
    if (!empty($listaErrores)) {
        $hayErrores = true;
        break;
    }
}

if ($hayErrores){
    // Guardamos errores y datos para mostrarlos
    $_SESSION['errores'] = $errores;
    $_SESSION['datos'] = $datos;
    header('Location: ../vista/registro.php');
    exit;
} else {
    // Registro exitoso
    $_SESSION['datos'] = $datos;
    header('Location: ../vista/login.php');
    exit;
}
}
?>