<?php
session_start();
require_once '../modelo/modelo_usuarios.php';
require_once '../conexion/conexion_base_datos.php';

if (!isset($_SESSION['intentos'])){
    $_SESSION['intentos'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $errores = [];

    $datos_login = [
        'usuario_login' => sanear($_POST['usuario']),
        'contrasena_login' => trim($_POST['contrasena'])
    ];

    // 1. Validamos los campos
    $errores = validar_login($datos_login);

    $hayErroreslogin = false;
    foreach ($errores as $campo => $listaErrores) {
        if (!empty($listaErrores)) {
            $hayErroreslogin = true;
            break;
        }
    }

    if ($hayErroreslogin){
        $_SESSION['errores_campos'] = $errores;
        header('Location: ../vista/login.php');
        exit;
    }

    // 2. Control de intentos
    if ($_SESSION['intentos'] >= 3){
        $_SESSION['errores_login'] = 'Has superado el máximo de intentos';
        header('Location: ../vista/bloqueo.php');
        exit;
    }

    // 3. CONSULTA AL MODELO
    $usuariobd = obtener_usuario_por_login($conexion, $datos_login['usuario_login']);

    // 4. VERIFICACIÓN FINAL
    if ($usuariobd && password_verify($datos_login['contrasena_login'], $usuariobd['contrasena'])){
        // ÉXITO
        $_SESSION['usuario'] = $usuariobd['usuario'];
        $_SESSION['id'] = $usuariobd['id'];
        $_SESSION['rol'] = $usuariobd['rol'];
        $_SESSION['foto_perfil'] = $usuariobd['foto_perfil'] ?? 'avatar_default.png';
        $_SESSION['intentos'] = 0;

        if (isset($_POST['recordar'])) {
            setcookie('recordar_usuario', $datos_login['usuario_login'], time() + (86400 * 30), "/");
        } else {
            setcookie('recordar_usuario', '', time() - 3600, "/");
        }

        header('Location: ../vista/Inicio.php');
        exit;
    } else {
        // FALLO
        $_SESSION['errores_login'] = "Usuario o contraseña incorrectos";
        $_SESSION['intentos']++;
        header("Location: ../vista/login.php");
        exit;
    }
}
?>