<?php
session_start();
require_once '../modelo/modelo_usuarios.php';
require_once '../conexion/conexion_base_datos.php';

if (!isset($_SESSION['intentos'])){
    $_SESSION['intentos']=0;
}

$cookie_usuario=$_COOKIE['recordar_usuario'] ?? "";


if ($_SERVER['REQUEST_METHOD']==='POST'){
    $errores=[];

$datos_login=[
'usuario_login' => sanear($_POST['usuario']),

'contrasena_login' => sanear($_POST['contrasena'])

];

$errores=validar_login($datos_login);

$hayErroreslogin = false;
foreach ($errores as $campo => $listaErrores) {
    if (!empty($listaErrores)) {
        $hayErroreslogin = true;
        break;
    }
}

if ($hayErroreslogin){
    $_SESSION['errores_campos']=$errores;
    header('Location:../vista/login.php');
    exit;
}

if ($_SESSION['intentos'] >= 3){
    $_SESSION['errores_login']='Has superado el máximo de intentos';
    header('Location: ../vista/login.php');
    exit;
}

//Cogemos los datos de la base de datos
$stmt=mysqli_prepare($conexion,"SELECT * FROM usuarios WHERE usuarios=? ");

mysqli_stmt_bind_param($stmt,"s",$datos_login['usuario_login']);

mysqli_stmt_execute($stmt);

$usuariobd= mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));


if ($usuariobd && password_verify($datos_login['contrasena_login'],$usuariobd['contrasena'])){
    $_SESSION['usuario']=$usuariobd['usuario'];
    $_SESSION['id']=$usuariobd['id'];
    $_SESSION['intentos']=0;

    header('Location: ../vista/panel.php');


} else {
    $_SESSION['errores_login']="Usuario o contraseña incorectos";
    $_SESSION['intentos']++;
    header("Location: ../vista/login.php");
    exit;
}



}
?>