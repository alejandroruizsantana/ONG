<?php

// inserta una donación en la base de datos, diferenciando si el donante está registrado o es anónimo
function insertar_donacion($conexion, $id_usuario, $nombre, $email, $cantidad, $metodo_pago) {
    if ($id_usuario === null) {
        // donación anónima: no guardamos id_usuario
        $sql = "INSERT INTO donaciones (nombre_donante, email_donante, cantidad, metodo_pago) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $sql);
        if (!$stmt) {
            return false;
        }
        mysqli_stmt_bind_param($stmt, "ssis", $nombre, $email, $cantidad, $metodo_pago);
    } else {
        // donación identificada: guardamos también el id del usuario registrado
        $sql = "INSERT INTO donaciones (id_usuario, nombre_donante, email_donante, cantidad, metodo_pago) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $sql);
        if (!$stmt) {
            return false;
        }
        mysqli_stmt_bind_param($stmt, "issis", $id_usuario, $nombre, $email, $cantidad, $metodo_pago);
    }

    // ejecutamos la consulta y cerramos el statement
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}

// devuelve la suma total de todas las donaciones que ha hecho un usuario concreto
function obtener_total_donaciones_usuario($conexion, $id_usuario) {
    $sql = "SELECT SUM(cantidad) AS total FROM donaciones WHERE id_usuario = ?";
    $stmt = mysqli_prepare($conexion, $sql);

    if (!$stmt) {
        return 0;
    }

    mysqli_stmt_bind_param($stmt, "i", $id_usuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $fila = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);

    // si no hay donaciones el sum devuelve null, con ?? 0 evitamos errores
    return floatval($fila['total'] ?? 0);
}

// devuelve la suma total de todas las donaciones recibidas por la ong
function obtener_total_donaciones_totales($conexion) {
    $sql = "SELECT SUM(cantidad) AS total FROM donaciones";
    $resultado = mysqli_query($conexion, $sql);
    if ($resultado) {
        $fila = mysqli_fetch_assoc($resultado);
        return floatval($fila['total'] ?? 0);
    }
    return 0;
}

// devuelve el objetivo de donación activo más reciente para mostrarlo en la vista de donaciones
function obtener_objetivo_activo($conexion) {
    // filtramos por activo = 1 y cogemos solo el más reciente por si hubiera varios
    $sql = "SELECT id, titulo, descripcion, monto_objetivo FROM objetivos WHERE activo = 1 ORDER BY fecha_creacion DESC LIMIT 1";
    $resultado = mysqli_query($conexion, $sql);
    if ($resultado) {
        return mysqli_fetch_assoc($resultado);
    }
    return null;
}