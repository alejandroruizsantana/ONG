<?php


// Obtener el resultado de las quedadas para recorrerlo en la vista
function obtener_resultado_quedadas($conexion) {
    $sql = "SELECT id, titulo, descripcion, fecha, hora_inicio, hora_fin, ubicacion, provincia, plazas_totales, plazas_ocupadas, estado 
            FROM quedadas 
            WHERE estado = 'disponible' 
            ORDER BY fecha ASC";
            
    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        mysqli_stmt_execute($stmt);
        // Devolvemos el recurso/resultado en bruto directamente
        $resultado = mysqli_stmt_get_result($stmt);
        return $resultado; 
    }
    
    return false;
}




// Insertar la inscripción de un usuario
function insertar_inscripcion_usuario($conexion, $id_usuario, $id_quedada) {
    $sql = "INSERT INTO inscripciones (id_usuario, id_quedada) VALUES (?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $id_usuario, $id_quedada);
        
        
        try {
            $exito = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            return $exito; // Devuelve true si se inserta por primera vez
        } 
        // Para evitar duplicados en las quedadas
        catch (mysqli_sql_exception $e) {
            mysqli_stmt_close($stmt);
            
            
            if ($e->getCode() === 1062) {
                return 'duplicado'; 
            }
            
           
        }
    }
    return false;
}

// Para Sumar +1 a las plazas ocupadas
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

// Función para ver todas las quedadas en el panel admin (incluyendo las llenas)
function obtener_quedadas_admin($conexion) {
    $sql = "SELECT * FROM quedadas ORDER BY fecha ASC";
    return mysqli_query($conexion, $sql);
}

// Función para listar los voluntarios de una quedada concreta
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

// Función 1: Resetea el contador de la tabla quedadas
 
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


 //Función 2: Borra todos los inscritos de una quedada específica
 
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

function obtener_estadisticas_admin($conexion) {
    $metrics = [
        'total_quedadas' => 0,
        'total_usuarios' => 0,
        'total_plazas_ocupadas' => 0
    ];

    $resQ = mysqli_query($conexion, "SELECT COUNT(id) AS cnt, COALESCE(SUM(plazas_ocupadas),0) AS suma FROM quedadas");
    if ($resQ) {
        $r = mysqli_fetch_assoc($resQ);
        $metrics['total_quedadas'] = intval($r['cnt']);
        $metrics['total_plazas_ocupadas'] = intval($r['suma']);
    }

    $resU = mysqli_query($conexion, "SELECT COUNT(id) AS cnt FROM usuarios");
    if ($resU) {
        $r = mysqli_fetch_assoc($resU);
        $metrics['total_usuarios'] = intval($r['cnt']);
    }

    return $metrics;
}
?>


