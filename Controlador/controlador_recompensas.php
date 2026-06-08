<?php
//Iniciamos la sesion y incluimos los archivos que nos haga falta
session_start();

include_once __DIR__ . '/../conexion/conexion_base_datos.php';
include_once __DIR__ . '/../Modelo/modelo_donaciones.php';

// obtenemos el objetivo de donación activo desde la base de datos
$objetivo = obtener_objetivo_activo($conexion);

// si no hay objetivo activo usamos valores por defecto
$objetivo_donacion = $objetivo['monto_objetivo'] ?? 0;
$titulo_objetivo = $objetivo['titulo'] ?? 'Objetivo de donación';
$descripcion_objetivo = $objetivo['descripcion'] ?? 'Apoya la conservación del lince.';

// obtenemos el total de todas las donaciones recibidas hasta ahora
$total_recaudado = obtener_total_donaciones_totales($conexion);

// calculamos cuánto queda para llegar al objetivo (mínimo 0, nunca negativo)
$restante_objetivo = max(0, $objetivo_donacion - $total_recaudado);

// calculamos el porcentaje completado, limitado a 100% aunque se supere el objetivo
$porcentaje_objetivo = $objetivo_donacion > 0 ? min(100, round(($total_recaudado / $objetivo_donacion) * 100)) : 0;

// si hay un usuario logueado obtenemos el total que ha donado él personalmente
$total_donado_usuario = 0;
if (isset($_SESSION['id']) && intval($_SESSION['id']) > 0) {
    $total_donado_usuario = obtener_total_donaciones_usuario($conexion, intval($_SESSION['id']));
}