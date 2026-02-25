<?php
$conexion=mysqli_connect('localhost','root','','usuariosong');

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
};

?>
