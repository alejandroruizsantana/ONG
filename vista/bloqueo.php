<?php
// página de bloqueo: se muestra cuando el usuario supera los 3 intentos fallidos de login
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// si no hay mensaje de bloqueo redirigimos al login
if (!isset($_SESSION['errores_login'])) {
    header('Location: ../vista/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Acceso Bloqueado | El Latido del Lince</title>
</head>
<body class="min-h-screen flex items-center justify-center" style="background-color: #161616;">

    <div class="text-center px-6 max-w-md mx-auto">

        <!-- icono de bloqueo -->
        <div class="w-24 h-24 bg-red-500/10 border border-red-500/30 rounded-full flex items-center justify-center mx-auto mb-8">
            <i class="fa-solid fa-lock text-red-500 text-4xl"></i>
        </div>

        <!-- título -->
        <h1 class="text-4xl font-serif font-bold text-white mb-4">
            Acceso <span class="text-red-500">Bloqueado</span>
        </h1>

        <!-- mensaje de error -->
        <p class="text-gray-400 text-lg mb-4">
            Has superado el número máximo de intentos de inicio de sesión.
        </p>

        <p class="text-gray-500 text-sm mb-10">
            Por seguridad, tu acceso ha sido bloqueado temporalmente. 
            Recarga la página para volver a intentarlo.
        </p>

        <!-- botón para volver al login y resetear el contador -->
        <a href="../Controlador/controlador_logout.php" 
           class="inline-flex items-center gap-2 bg-[#D2691E] hover:bg-[#b85c1a] text-white font-bold px-8 py-4 rounded-xl transition-colors">
            <i class="fa-solid fa-rotate-left"></i>
            Volver a intentarlo
        </a>

        <!-- enlace a la página principal -->
        <div class="mt-6">
            <a href="../index.php" class="text-gray-500 hover:text-[#D2691E] text-sm transition-colors">
                Volver a la página principal
            </a>
        </div>

    </div>

</body>
</html>