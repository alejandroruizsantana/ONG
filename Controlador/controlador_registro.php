<?php
require_once '../modelo/modelo_usuarios.php';
require_once '../conexion/conexion_base_datos.php';

session_start();
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $login_correcto=false;

    $datos = [
        'usuario' => sanear($_POST['usuario']),
        'email' => sanear($_POST['email']),
        'contraseña' => trim($_POST['contraseña']),
    ];

    // Validamos
    $errores = validar($datos);

  // 2. Verificación de duplicados en BD si la conexión existe 
    if ($conexion) {
        $errores_duplicados = comprobar_duplicados_registro($conexion, $datos['usuario'], $datos['email']);
        if (isset($errores_duplicados['usuario'])) {
            $errores['usuario'][] = $errores_duplicados['usuario'];
        }
        if (isset($errores_duplicados['email'])) {
            $errores['email'][] = $errores_duplicados['email'];
        }
    }


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
    header('Location: ../vista/registro.php');
    exit;
} else {
    // Registro exitoso
    $_SESSION['datos_registro'] = $datos;

    // Encriptar contraseña
    $contrasena_cifrada = password_hash($datos['contraseña'], PASSWORD_DEFAULT);

    // Inserción en BD
    registrar_usuario($conexion, $datos['usuario'], $datos['email'], $contrasena_cifrada);

    mysqli_close($conexion);
    header('Location: ../vista/login.php');
    exit;
}

    
}

// Si la página se carga directamente
require_once '../vista/registro.php';
?>