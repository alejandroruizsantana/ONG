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
?>


