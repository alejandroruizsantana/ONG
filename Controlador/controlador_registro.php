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
        'contrasena' => sanear($_POST['contrasena']),
    ];

    // Validamos
    $errores = validar($datos);

  // 2. Verificación de duplicados en BD (Solo si la conexión existe)
    if ($conexion) {

        $sql_check = "SELECT usuario, email FROM usuarios WHERE usuario = ? OR email = ?";

        $stmt_check = mysqli_prepare($conexion, $sql_check);

        mysqli_stmt_bind_param($stmt_check, "ss", $datos['usuario'], $datos['email']);

        mysqli_stmt_execute($stmt_check);
        
        $resultado = mysqli_stmt_get_result($stmt_check);

        while ($fila = mysqli_fetch_assoc($resultado)) {
            if ($fila['usuario'] === $datos['usuario']) {
                $errores['usuario'][] = "El nombre de usuario ya está en uso.";
            }
            if ($fila['email'] === $datos['email']) {
                $errores['email'][] = "Este correo electrónico ya está registrado.";
            }
        }
        mysqli_stmt_close($stmt_check);
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
    $contrasena_cifrada = password_hash($datos['contrasena'], PASSWORD_DEFAULT);

    // Preparar consulta
    $stmt = mysqli_prepare($conexion, "INSERT INTO usuarios(usuario,email,contrasena) VALUES(?, ?, ?)");

    if ($stmt){
        mysqli_stmt_bind_param($stmt, "sss", $datos['usuario'], $datos['email'], $contrasena_cifrada);

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