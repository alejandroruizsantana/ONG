<?php
// Iniciamos la sesion y incluimos lo que nos haga falta
session_start();
require_once '../modelo/modelo_usuarios.php';
require_once '../conexion/conexion_base_datos.php';

// si no existe el contador de intentos en sesión lo inicializamos a 0
if (!isset($_SESSION['intentos'])){
    $_SESSION['intentos'] = 0;
}

// solo procesamos si el formulario llega por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $errores = [];

    // saneamos los datos del formulario para evitar xss
    $datos_login = [
        'usuario_login' => sanear($_POST['usuario']),
        'contrasena_login' => trim($_POST['contrasena'])
    ];

    // validamos que los campos no estén vacíos
    $errores = validar_login($datos_login);

    // recorremos el array de errores para saber si hay alguno
    $hayErroreslogin = false;
    foreach ($errores as $campo => $listaErrores) {
        if (!empty($listaErrores)) {
            $hayErroreslogin = true;
            break;
        }
    }

    // si hay errores de validación los guardamos en sesión y volvemos al formulario
    if ($hayErroreslogin){
        $_SESSION['errores_campos'] = $errores;
        header('Location: ../vista/login.php');
        exit;
    }

    // si el usuario lleva 3 o más intentos fallidos lo bloqueamos
    if ($_SESSION['intentos'] >= 3){
        $_SESSION['errores_login'] = 'Has superado el máximo de intentos';
        header('Location: ../vista/bloqueo.php');
        exit;
    }

    // buscamos el usuario en la base de datos por su nombre de usuario
    $usuariobd = obtener_usuario_por_login($conexion, $datos_login['usuario_login']);

    // comprobamos que el usuario existe y que la contraseña coincide con el hash de la bd
    if ($usuariobd && password_verify($datos_login['contrasena_login'], $usuariobd['contrasena'])){
        // login correcto: guardamos los datos del usuario en sesión y reseteamos intentos
        $_SESSION['usuario'] = $usuariobd['usuario'];
        $_SESSION['id'] = $usuariobd['id'];
        $_SESSION['rol'] = $usuariobd['rol'];
        $_SESSION['foto_perfil'] = $usuariobd['foto_perfil'] ?? 'avatar_default.png';
        $_SESSION['intentos'] = 0;

        // si marcó "recordarme" creamos una cookie de 30 días, si no la eliminamos
        if (isset($_POST['recordar'])) {
            setcookie('recordar_usuario', $datos_login['usuario_login'], time() + (86400 * 30), "/");
        } else {
            setcookie('recordar_usuario', '', time() - 3600, "/");
        }

        // redirigimos al panel de admin o al perfil según el rol del usuario
        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') {
            header('Location: controlador_admin.php');
        } else {
            header('Location: ../vista/perfil_usuario.php');
        }
        exit;
    } else {
        // login fallido: guardamos el error y sumamos un intento
        $_SESSION['errores_login'] = "Usuario o contraseña incorrectos";
        $_SESSION['intentos']++;
        header("Location: ../vista/login.php");
        exit;
    }
}
?>