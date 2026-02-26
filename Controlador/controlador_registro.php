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


    // Conexión a la base de datos
 
    if (!$conexion){
        die("Error de conexión a base de datos: " . mysqli_connect_error());
    }

    // Encriptar contraseña
    $contraseña_cifrada = password_hash($datos['contrasena'], PASSWORD_DEFAULT);

    // Preparar consulta
    $stmt = mysqli_prepare($conexion, "INSERT INTO usuarios(usuario,email,contrasena) VALUES(?, ?, ?)");

    if ($stmt){
        mysqli_stmt_bind_param($stmt, "sss", $datos['usuario'], $datos['email'], $contraseña_cifrada);

        if (!mysqli_stmt_execute($stmt)){
            echo "Error al insertar: " . mysqli_stmt_error($stmt);
            exit; 
        }
    } else {
        echo "Error al preparar la consulta: " . mysqli_error($conexion);
        exit;
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
    header('Location: ../vista/login.php');
    exit;
}

    
}

// Si la página se carga directamente
require_once '../vista/registro.php';
?>