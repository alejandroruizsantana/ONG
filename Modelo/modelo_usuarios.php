<?php

// convierte caracteres especiales a entidades html para evitar xss
function sanear($dato){
    return htmlspecialchars($dato);
}

// valida los datos del formulario de registro y devuelve un array de errores
function validar($datos){
    $errores = [
        'usuario' => [],
        'email' => [],
        'contraseña' => []
    ];

    // comprobamos que el usuario no esté vacío
    if (empty($datos['usuario'])){
        $errores['usuario'][] = "El campo usuario está vacío";
    }
    // el nombre de usuario debe tener entre 3 y 20 caracteres
    if(strlen($datos['usuario']) < 3 || strlen($datos['usuario']) > 20) {
        $errores['usuario'][] = "El nombre de usuario debe tener entre 3 y 20 caracteres.";
    }
    // solo permitimos letras, números y guiones bajos
    if(!preg_match("/^[a-zA-Z0-9_]+$/", $datos['usuario'])) {
        $errores['usuario'][] = "El nombre de usuario solo puede contener letras, números y guiones bajos.";
    }

    // comprobamos que el email no esté vacío y tenga formato válido
    if (empty($datos['email'])){
        $errores['email'][] = "El campo email está vacío";
    } elseif (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)){
        $errores['email'][] = "Formato de email no válido";
    }

    // comprobamos que la contraseña no esté vacía y tenga al menos 4 caracteres
    if (empty($datos['contraseña'])){
        $errores['contraseña'][] = "El campo contraseña está vacío";
    } elseif (strlen($datos['contraseña']) < 4){
        $errores['contraseña'][] = "El campo contraseña debe contener como mínimo 4 caracteres.";
    }

    return $errores;
}

// valida que los campos del formulario de login no estén vacíos
function validar_login($datos_login){
    $errores = [
        'usuario' => [],
        'contraseña' => []
    ];

    if (empty($datos_login['usuario_login'])){
        $errores['usuario'][] = "El campo usuario está vacío";
    }

    if (empty($datos_login['contrasena_login'])){
        $errores['contraseña'][] = "El campo contraseña está vacío";
    }

    return $errores;
}

// busca un usuario por su id y devuelve sus datos
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

// actualiza los datos del usuario, construyendo la query según los campos que hayan cambiado
function actualizar_usuario($conexion, $id_usuario, $usuario, $contrasena_cifrada = null, $foto_perfil = null) {
    // actualizamos usuario, contraseña y foto
    if ($contrasena_cifrada !== null && $foto_perfil !== null) {
        $sql = "UPDATE usuarios SET usuario = ?, contrasena = ?, foto_perfil = ? WHERE id = ?";
        $stmt = mysqli_prepare($conexion, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssi", $usuario, $contrasena_cifrada, $foto_perfil, $id_usuario);
        }
    // actualizamos solo usuario y contraseña
    } elseif ($contrasena_cifrada !== null) {
        $sql = "UPDATE usuarios SET usuario = ?, contrasena = ? WHERE id = ?";
        $stmt = mysqli_prepare($conexion, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssi", $usuario, $contrasena_cifrada, $id_usuario);
        }
    // actualizamos solo usuario y foto
    } elseif ($foto_perfil !== null) {
        $sql = "UPDATE usuarios SET usuario = ?, foto_perfil = ? WHERE id = ?";
        $stmt = mysqli_prepare($conexion, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssi", $usuario, $foto_perfil, $id_usuario);
        }
    // actualizamos solo el nombre de usuario
    } else {
        $sql = "UPDATE usuarios SET usuario = ? WHERE id = ?";
        $stmt = mysqli_prepare($conexion, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "si", $usuario, $id_usuario);
        }
    }

    if (!$stmt) {
        return false;
    }

    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}

// valida la imagen subida: comprueba que tenga extensión permitida y no supere 2mb
function validar_imagen($archivo) {
    if (empty($archivo) || empty($archivo['name'])) {
        return 'No se ha seleccionado ninguna imagen.';
    }

    if ($archivo['error'] !== UPLOAD_ERR_OK) {
        return 'Error al subir la imagen.';
    }

    $ext = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
    $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($ext, $extensiones_permitidas, true)) {
        return 'Formato no válido. Usa JPG, PNG o GIF.';
    }

    if ($archivo['size'] > 2 * 1024 * 1024) {
        return 'La imagen supera el tamaño máximo de 2 MB.';
    }

    // si todo es correcto devolvemos la extensión para usarla al guardar el archivo
    return $ext;
}

// valida la nueva contraseña, si ambos campos están vacíos significa que no quiere cambiarla
function validar_nueva_contrasena($nueva_pass, $confirmar_pass) {
    if ($nueva_pass === '' && $confirmar_pass === '') {
        return true;
    }
    if ($nueva_pass !== $confirmar_pass) {
        return 'Las contraseñas no coinciden.';
    }
    if (strlen($nueva_pass) < 4) {
        return 'La contraseña debe tener al menos 4 caracteres.';
    }
    return true;
}

// genera un nombre único para la foto de perfil usando el id del usuario y el timestamp actual
function generar_nombre_imagen($id_usuario, $ext) {
    return 'perfil_' . intval($id_usuario) . '_' . time() . '.' . $ext;
}

// comprueba en la bd si el nombre de usuario o el email ya están en uso
function comprobar_duplicados_registro($conexion, $usuario, $email) {
    $errores_duplicados = [];
    $sql_check = "SELECT usuario, email FROM usuarios WHERE usuario = ? OR email = ?";
    $stmt_check = mysqli_prepare($conexion, $sql_check);
    
    if ($stmt_check) {
        mysqli_stmt_bind_param($stmt_check, "ss", $usuario, $email);
        mysqli_stmt_execute($stmt_check);
        $resultado = mysqli_stmt_get_result($stmt_check);

        // recorremos los resultados y marcamos qué campo está duplicado
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

// inserta un nuevo usuario en la base de datos con el avatar por defecto si no se sube foto
function registrar_usuario($conexion, $usuario, $email, $contrasena_cifrada, $foto_por_defecto = 'avatar_default.jpg') {
    $sql = "INSERT INTO usuarios(usuario, email, contrasena, foto_perfil) VALUES(?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $usuario, $email, $contrasena_cifrada, $foto_por_defecto);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

// busca un usuario por su nombre de usuario para usarlo en el proceso de login
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

// elimina un usuario de la base de datos por su id
function eliminar_usuario($conexion, $id_usuario) {
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id_usuario);
        $ejecucion = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $ejecucion;
    }
    return false;
}

// actualiza usuario, email y rol desde el panel de administración
function actualizar_usuario_admin($conexion, $id_usuario, $usuario, $email, $rol) {
    $sql = "UPDATE usuarios SET usuario = ?, email = ?, rol = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssi", $usuario, $email, $rol, $id_usuario);
        $ejecucion = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $ejecucion;
    }
    return false;
}

// devuelve todos los usuarios ordenados alfabéticamente para listarlos en el panel admin
function obtener_todos_usuarios($conexion) {
    $sql = "SELECT id, usuario, email, rol FROM usuarios ORDER BY usuario ASC";
    return mysqli_query($conexion, $sql);
}