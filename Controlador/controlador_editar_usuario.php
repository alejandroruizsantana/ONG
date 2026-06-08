<?php
// Incluimos los archivos y iniciamos sesion
session_start();
include_once '../conexion/conexion_base_datos.php';
include_once '../Modelo/modelo_usuarios.php';

// si no hay sesión activa redirigimos al login
if (!isset($_SESSION['usuario']) || !isset($_SESSION['id'])) {
    header("Location: ../vista/login.php");
    exit;
}

// solo procesamos si el formulario llega por POST con la acción correcta
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'guardar_perfil') {
    $id = intval($_SESSION['id']);
    $usuario = trim($_POST['nuevo_usuario'] ?? '');
    $nueva_pass = trim($_POST['nueva_pass'] ?? '');
    $confirmar_pass = trim($_POST['confirmar_pass'] ?? '');

    // obtenemos los datos actuales del usuario para tener la foto que ya tiene guardada
    $usuario_datos = obtener_usuario_por_id($conexion, $id);
    if (!$usuario_datos) {
        header('Location: ../vista/login.php');
        exit;
    }

    // si no tiene foto usamos el avatar por defecto
    $foto_perfil = $usuario_datos['foto_perfil'] ?? 'avatar_default.jpg';

    // validamos que las dos contraseñas coincidan y cumplan el mínimo de caracteres
    $resultado_validacion_contrasena = validar_nueva_contrasena($nueva_pass, $confirmar_pass);
    if ($resultado_validacion_contrasena !== true) {
        $_SESSION['mensaje_error'] = $resultado_validacion_contrasena;
        header('Location: ../Controlador/controlador_editar_usuario.php');
        exit();
    }

    // solo procesamos la imagen si el usuario ha subido una nueva
    if (!empty($_FILES['nueva_foto']['name'])) {
        $validacion_imagen = validar_imagen($_FILES['nueva_foto']);
        $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif'];

        // validar_imagen devuelve la extensión si es válida, o un mensaje de error si no lo es
        if (!in_array($validacion_imagen, $extensiones_permitidas, true)) {
            $_SESSION['mensaje_error'] = $validacion_imagen;
            header('Location: ../Controlador/controlador_editar_usuario.php');
            exit();
        }

        // generamos un nombre único para la imagen y la movemos a la carpeta de destino
        $ext = $validacion_imagen;
        $nuevo_nombre = generar_nombre_imagen($id, $ext);
        $destino = __DIR__ . '/../assets/imagenes/' . $nuevo_nombre;

        // intenta mover la imagen de la carpeta temporal de php a la carpeta definitiva,
        // si falla (carpeta sin permisos o ruta incorrecta) guarda el error y vuelve al formulario
        if (!move_uploaded_file($_FILES['nueva_foto']['tmp_name'], $destino)) {
            $_SESSION['mensaje_error'] = 'Error al guardar la imagen de perfil.';
            header('Location: ../Controlador/controlador_editar_usuario.php');
            exit();
        }

        // borramos la foto anterior del servidor si no es el avatar por defecto
        if (!empty($usuario_datos['foto_perfil']) && $usuario_datos['foto_perfil'] !== 'avatar_default.jpg') {
            $antigua = __DIR__ . '/../assets/imagenes/' . $usuario_datos['foto_perfil'];
            if (file_exists($antigua)) unlink($antigua);
        }

        $foto_perfil = $nuevo_nombre;
    }

    // si el usuario ha introducido nueva contraseña la ciframos con bcrypt
    $contrasena_cifrada = null;
    if (!empty($nueva_pass)) {
        $contrasena_cifrada = password_hash($nueva_pass, PASSWORD_DEFAULT);
    }

    // actualizamos los datos en la base de datos
    $actualizado = actualizar_usuario($conexion, $id, $usuario, $contrasena_cifrada, $foto_perfil);
    if ($actualizado) {
        // actualizamos también la sesión para que el header muestre los datos nuevos
        $_SESSION['usuario'] = $usuario;
        $_SESSION['foto_perfil'] = $foto_perfil;
        $_SESSION['mensaje_exito'] = 'Perfil actualizado correctamente.';
    } else {
        $_SESSION['mensaje_error'] = 'No se pudo actualizar el perfil. Intenta de nuevo.';
    }

    // volvemos al formulario para mostrar el mensaje de éxito o error
    header('Location: ../Controlador/controlador_editar_usuario.php');
    exit();
}

// cargamos los datos del usuario para rellenar el formulario
$usuario_datos = obtener_usuario_por_id($conexion, $_SESSION['id']);
if (!$usuario_datos) {
    header("Location: ../vista/login.php");
    exit;
}

// mostramos la vista del formulario de edición
include_once '../vista/editar_usuario.php';
exit();