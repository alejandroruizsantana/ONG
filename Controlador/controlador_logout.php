<?php
// Reanudamos la sesión existente para poder manipularla
session_start();

//  Vaciamos todas las variables de sesión ($_SESSION['usuario'], $_SESSION['rol'], etc.)
session_unset();

//  Destruimos la sesión por completo en el servidor
session_destroy();

//  Redirigimos al usuario al login o al inicio
header("Location: ../vista/login.php");
exit; 
?>