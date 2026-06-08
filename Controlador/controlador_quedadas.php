<?php
// Controlador de quedadas: carga las quedadas disponibles y prepara la vista de quedadas.
session_start();
include_once '../conexion/conexion_base_datos.php';
include_once '../Modelo/modelo_quedadas.php';

// Obtener lista de quedadas para la vista
$resultadoQuedadas = obtener_resultado_quedadas($conexion);

include_once '../vista/quedadas.php';
exit();
