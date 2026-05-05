<?php

//Sanear datos

function sanear($dato){
    return htmlspecialchars($dato);
}

//Validar datos registro

function validar($datos){
    $errores = [
        'usuario' => [],
        'email' => [],
        'contraseña' => []
    ];

    // Validación usuario
    if (empty($datos['usuario'])){
        $errores['usuario'][] = "El campo usuario está vacío";
    }
    if(strlen($datos['usuario']) < 3 || strlen($datos['usuario']) > 20) {
        $errores['usuario'][] = "El nombre de usuario debe tener entre 3 y 20 caracteres.";
    }
    if(!preg_match("/^[a-zA-Z0-9_]+$/", $datos['usuario'])) {
        $errores['usuario'][] = "El nombre de usuario solo puede contener letras, números y guiones bajos.";
    }

    // Validación email
    if (empty($datos['email'])){
        $errores['email'][] = "El campo email está vacío";
    } elseif (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)){
        $errores['email'][] = "Formato de email no válido";
    }

    // Validación contraseña
    if (empty($datos['contraseña'])){
        $errores['contraseña'][] = "El campo contraseña está vacío";
    } elseif (strlen($datos['contraseña']) < 4){
        $errores['contraseña'][] = "El campo contraseña debe contener como mínimo 4 caracteres.";
    }

    return $errores;


}

// Validaciones del login
function validar_login($datos_login){
    $errores = [
        'usuario' => [],
        'contraseña' => []
    ];

    //Si el campo usuario esta vacio mostramos el error
    if (empty($datos_login['usuario_login'])){
        $errores['usuario'][] = "El campo usuario está vacío";
    }

    // Si el campo contraseña esta vacio mostramos el error de contraseña vacia
    if (empty($datos_login['contrasena_login'])){
        $errores['contraseña'][] = "El campo contraseña está vacío";
    }

    return $errores;
}

// Obtener datos completos del usuario por ID
function obtener_usuario_por_id($conexion, $id) {
    $sql = "SELECT id, usuario, email, rol, foto_perfil FROM usuarios WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    
    if (!$stmt) {
        return null;
    }
    
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $usuario_datos = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);
    
    return $usuario_datos;
}

// Comprobar si el usuario o el email ya existen (para el registro)
function comprobar_duplicados_registro($conexion, $usuario, $email) {
    $errores_duplicados = [];
    $sql_check = "SELECT usuario, email FROM usuarios WHERE usuario = ? OR email = ?";
    $stmt_check = mysqli_prepare($conexion, $sql_check);
    
    if ($stmt_check) {
        mysqli_stmt_bind_param($stmt_check, "ss", $usuario, $email);
        mysqli_stmt_execute($stmt_check);
        $resultado = mysqli_stmt_get_result($stmt_check);

        while ($fila = mysqli_fetch_assoc($resultado)) {
            if ($fila['usuario'] === $usuario) {
                $errores_duplicados['usuario'] = "El nombre de usuario ya está en uso.";
            }
            if ($fila['email'] === $email) {
                $errores_duplicados['email'] = "Este correo electrónico ya está registrado.";
            }
        }
        mysqli_stmt_close($stmt_check);
    }
    return $errores_duplicados;
}

// Insertar un nuevo usuario en la base de datos
function registrar_usuario($conexion, $usuario, $email, $contrasena_cifrada, $foto_por_defecto = 'avatar_default.jpg') {
    $sql = "INSERT INTO usuarios(usuario, email, contrasena, foto_perfil) VALUES(?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $usuario, $email, $contrasena_cifrada, $foto_por_defecto);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

// Obtener un usuario por su nombre de usuario (para el login)
function obtener_usuario_por_login($conexion, $usuario_login) {
    $sql = "SELECT id, usuario, contrasena, rol, foto_perfil FROM usuarios WHERE usuario = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    $usuariobd = null;

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $usuario_login);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $usuariobd = $fila;
        }
        mysqli_stmt_close($stmt);
    }
    return $usuariobd;
}