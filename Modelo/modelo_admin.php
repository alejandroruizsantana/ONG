<?php

// devuelve un array con las estadísticas globales para el panel de administración
function obtener_estadisticas_admin($conexion) {

    // inicializamos el array con los valores a 0 por si alguna consulta falla
    $metrics = [
        'total_quedadas' => 0,
        'total_usuarios' => 0,
        'total_plazas_ocupadas' => 0
    ];

    // contamos el total de quedadas y sumamos todas las plazas ocupadas de una sola consulta
    // coalesce evita que el sum devuelva null si no hay registros
    $resQ = mysqli_query($conexion, "SELECT COUNT(id) AS cnt, COALESCE(SUM(plazas_ocupadas),0) AS suma FROM quedadas");
    if ($resQ) {
        $r = mysqli_fetch_assoc($resQ);
        $metrics['total_quedadas'] = intval($r['cnt']);
        $metrics['total_plazas_ocupadas'] = intval($r['suma']);
    }

    // contamos el total de usuarios registrados
    $resU = mysqli_query($conexion, "SELECT COUNT(id) AS cnt FROM usuarios");
    if ($resU) {
        $r = mysqli_fetch_assoc($resU);
        $metrics['total_usuarios'] = intval($r['cnt']);
    }

    return $metrics;
}
?>