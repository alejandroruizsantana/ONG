<?php
$conexion=mysqli_connect('localhost','root','','bdong');

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
};

?>
