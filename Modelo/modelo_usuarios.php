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
        'contrasena' => []
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
    if (empty($datos['contrasena'])){
        $errores['contrasena'][] = "El campo contraseña está vacío";
    } elseif (strlen($datos['contrasena']) < 4){
        $errores['contrasena'][] = "El campo contraseña debe contener como mínimo 4 caracteres.";
    }

    return $errores;


}

//Validaciones del login
function validar_login($datos_login){
    $errores =[
        'usuario' => [],
        'contrasena' => []
    ];

    if (empty($datos_login['usuario'])){
        $errores['usuario'][]="El campo usuario esta vacio";
    }

    if (empty($datos_login['contrasena'])){
        $errores['contrasena'][]="El campo contraseña esta vacio";
    }
    return $errores;
}
?>