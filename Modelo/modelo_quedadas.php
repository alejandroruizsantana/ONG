<?php

// devuelve todas las quedadas con estado 'disponible' ordenadas por fecha
function obtener_resultado_quedadas($conexion) {
    $sql = "SELECT id, titulo, descripcion, fecha, hora_inicio, hora_fin, ubicacion, provincia, plazas_totales, plazas_ocupadas, estado 
            FROM quedadas 
            WHERE estado = 'disponible' 
            ORDER BY fecha ASC";
            
    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        mysqli_stmt_execute($stmt);
        // devolvemos el resultado en bruto para recorrerlo en la vista
        $resultado = mysqli_stmt_get_result($stmt);
        return $resultado; 
    }
    
    return false;
}

// devuelve el número de quedadas futuras en las que está inscrito un usuario
function obtener_total_quedadas_pendientes_usuario($conexion, $id_usuario) {
    $sql = "SELECT COUNT(*) AS total 
            FROM inscripciones i 
            INNER JOIN quedadas q ON i.id_quedada = q.id 
            WHERE i.id_usuario = ? 
              AND q.fecha >= CURDATE()";

    $stmt = mysqli_prepare($conexion, $sql);
    if (!$stmt) {
        return 0;
    }

    mysqli_stmt_bind_param($stmt, "i", $id_usuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $fila = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);

    return intval($fila['total'] ?? 0);
}

// devuelve las próximas quedadas de un usuario ordenadas por fecha, con un límite de 4 por defecto
function obtener_proximas_quedadas_usuario($conexion, $id_usuario, $limite = 4) {
    $sql = "SELECT q.id, q.titulo, q.descripcion, q.fecha, q.hora_inicio, q.hora_fin, q.ubicacion, q.provincia 
            FROM inscripciones i 
            INNER JOIN quedadas q ON i.id_quedada = q.id 
            WHERE i.id_usuario = ? 
              AND q.fecha >= CURDATE() 
              AND q.estado = 'disponible' 
            ORDER BY q.fecha ASC 
            LIMIT ?";

    $stmt = mysqli_prepare($conexion, $sql);
    if (!$stmt) {
        return [];
    }

    mysqli_stmt_bind_param($stmt, "ii", $id_usuario, $limite);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $proximas = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);

    return $proximas;
}

// inserta una inscripción en la base de datos
function insertar_inscripcion_usuario($conexion, $id_usuario, $id_quedada) {
    $sql = "INSERT INTO inscripciones (id_usuario, id_quedada) VALUES (?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $id_usuario, $id_quedada);
        
        try {
            $exito = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            return $exito;
        } 
        // capturamos el error 1062 de mysql que indica clave duplicada (ya inscrito)
        catch (mysqli_sql_exception $e) {
            mysqli_stmt_close($stmt);
            if ($e->getCode() === 1062) {
                return 'duplicado'; 
            }
        }
    }
    return false;
}

// comprueba si un usuario ya está inscrito en una quedada concreta
function esta_inscrito($conexion, $id_usuario, $id_quedada) {
    $sql = "SELECT COUNT(*) AS cnt FROM inscripciones WHERE id_usuario = ? AND id_quedada = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, "ii", $id_usuario, $id_quedada);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $fila = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);
    return intval($fila['cnt'] ?? 0) > 0;
}

// resta 1 a las plazas ocupadas de una quedada, comprobando antes que no estén ya a 0
function decrementar_plazas_ocupadas($conexion, $id_quedada) {
    // obtenemos el valor actual para no bajar de 0
    $sql_obtener = "SELECT plazas_ocupadas FROM quedadas WHERE id = ?";
    $stmt_obtener = mysqli_prepare($conexion, $sql_obtener);
    if (!$stmt_obtener) return false;
    
    mysqli_stmt_bind_param($stmt_obtener, "i", $id_quedada);
    mysqli_stmt_execute($stmt_obtener);
    $resultado = mysqli_stmt_get_result($stmt_obtener);
    $fila = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt_obtener);
    
    $plazas_actuales = intval($fila['plazas_ocupadas'] ?? 0);
    
    // solo restamos si hay al menos una plaza ocupada
    if ($plazas_actuales > 0) {
        $sql = "UPDATE quedadas SET plazas_ocupadas = plazas_ocupadas - 1 WHERE id = ?";
        $stmt = mysqli_prepare($conexion, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $id_quedada);
            $exito = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            return $exito;
        }
    }
    return false;
}

// elimina la inscripción de un usuario en una quedada concreta
function eliminar_inscripcion_usuario($conexion, $id_usuario, $id_quedada) {
    $sql = "DELETE FROM inscripciones WHERE id_usuario = ? AND id_quedada = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $id_usuario, $id_quedada);
        $ejecucion = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $ejecucion;
    }
    return false;
}

// suma 1 a las plazas ocupadas cuando un usuario se inscribe
function incrementar_plazas_ocupadas($conexion, $id_quedada) {
    $sql = "UPDATE quedadas SET plazas_ocupadas = plazas_ocupadas + 1 WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    $exito = false;

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id_quedada);
        $exito = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    return $exito;
}

// devuelve todos los datos de una quedada buscándola por su id
function obtener_quedada_por_id($conexion, $id_quedada) {
    $sql = "SELECT * FROM quedadas WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id_quedada);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $quedada = mysqli_fetch_assoc($resultado);
        mysqli_stmt_close($stmt);
        return $quedada;
    }
    return false;
}

// actualiza los datos de una quedada existente
function actualizar_quedada($conexion, $id_quedada, $titulo, $descripcion, $fecha, $hora_inicio, $hora_fin, $ubicacion, $provincia, $plazas_totales) {
    $sql = "UPDATE quedadas SET titulo = ?, descripcion = ?, fecha = ?, hora_inicio = ?, hora_fin = ?, ubicacion = ?, provincia = ?, plazas_totales = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssssiii", $titulo, $descripcion, $fecha, $hora_inicio, $hora_fin, $ubicacion, $provincia, $plazas_totales, $id_quedada);
        $ejecucion = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $ejecucion;
    }
    return false;
}

// devuelve solo las quedadas disponibles para el panel admin
function obtener_quedadas_admin($conexion) {
    $sql = "SELECT * FROM quedadas WHERE estado = 'disponible' ORDER BY fecha ASC";
    return mysqli_query($conexion, $sql);
}

// devuelve el listado de voluntarios inscritos en una quedada concreta
function obtener_voluntarios_quedada($conexion, $id_quedada) {
    $sql = "SELECT u.nombre, u.email, i.fecha_inscripcion 
            FROM inscripciones i
            INNER JOIN usuarios u ON i.id_usuario = u.id
            WHERE i.id_quedada = ?
            ORDER BY i.fecha_inscripcion DESC";
            
    $stmt = mysqli_prepare($conexion, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id_quedada);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }
    return false;
}

// pone el contador de plazas ocupadas a 0 en una quedada
function resetear_contador_plazas($conexion, $id_quedada) {
    $sql = "UPDATE quedadas SET plazas_ocupadas = 0 WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id_quedada);
        $ejecucion = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $ejecucion;
    }
    return false;
}

// elimina todas las inscripciones de una quedada, se usa antes de archivarla
function eliminar_inscripciones_quedada($conexion, $id_quedada) {
    $sql = "DELETE FROM inscripciones WHERE id_quedada = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id_quedada);
        $ejecucion = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $ejecucion;
    }
    return false;
}

// elimina físicamente una quedada de la base de datos
function eliminar_quedada($conexion, $id_quedada) {
    $sql = "DELETE FROM quedadas WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id_quedada);
        $ejecucion = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $ejecucion;
    }
    return false;
}

// cambia el estado de una quedada, usado para archivarla sin borrarla físicamente
function cambiar_estado_quedada($conexion, $id_quedada, $nuevo_estado) {
    $sql = "UPDATE quedadas SET estado = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "si", $nuevo_estado, $id_quedada);
        $ejecucion = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $ejecucion;
    }
    return false;
}

// inserta una nueva quedada con plazas_ocupadas a 0 y estado 'disponible' por defecto
function insertar_quedada($conexion, $titulo, $descripcion, $fecha, $hora_inicio, $hora_fin, $ubicacion, $provincia, $plazas_totales, $estado = 'disponible') {
    $sql = "INSERT INTO quedadas (titulo, descripcion, fecha, hora_inicio, hora_fin, ubicacion, provincia, plazas_totales, plazas_ocupadas, estado) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0, ?)";
    $stmt = mysqli_prepare($conexion, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssssis", $titulo, $descripcion, $fecha, $hora_inicio, $hora_fin, $ubicacion, $provincia, $plazas_totales, $estado);
        $ejecucion = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $ejecucion;
    }
    return false;
}

// elimina todas las inscripciones de un usuario, se usa antes de eliminar su cuenta
function eliminar_inscripciones_usuario($conexion, $id_usuario) {
    $sql = "DELETE FROM inscripciones WHERE id_usuario = ?";
    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id_usuario);
        $ejecucion = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $ejecucion;
    }
    return false;
}

?>