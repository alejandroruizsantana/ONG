<?php
// Controlador de logout: cierra la sesión y redirige al login.
// Iniciamos la sesión para poder manipularla
session_start();

//  Vaciamos todas las variables de sesión 
session_unset();

//  Destruimos la sesión por completo 
session_destroy();

//  Redirigimos al usuario al login o al inicio
header("Location: ../vista/login.php");
exit; 
?>