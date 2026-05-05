<?php
/**
 * COMPONENTE: HEADER GENERAL - EL LATIDO DEL LINCE
 * El botón Donar ahora es un enlace limpio (sin fondo) situado a la derecha.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <script src="https://cdn.tailwindcss.com"></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Latido del Lince</title> 
</head>

<body class="min-h-screen flex flex-col font-sans pt-20">

<div id="mobile-menu" 
     class="hidden fixed inset-0 z-[100] flex-col justify-between font-serif text-[#1a4d2e] bg-white h-screen shadow-md">

    <div class="flex flex-col">
        <div class="flex items-center justify-between p-4 border-b border-gray-100">
            <img class="w-10 h-10" src="../assets/imagenes/logo.png" alt="Logo">
            <button onclick="toggleMenu()" class="text-[#1a4d2e] p-2 text-4xl font-sans leading-none">
                &times;
            </button>
        </div>

        <nav class="flex flex-col gap-6 p-8 text-lg items-start">
            <a href="../index.php" class="hover:text-[#D2691E]">Inicio</a>
            <a href="../vista/lince.php" class="hover:text-[#D2691E]">El Lince</a>
            <a href="../vista/quedada.php" class="hover:text-[#D2691E]">Quedadas</a>
            <a href="../vista/recompensas.php" class="hover:text-[#D2691E]">Recompensas</a>
            <a href="../vista/donar.php" class="w-full text-center py-3 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl flex items-center justify-center gap-2 font-sans mt-4 shadow-sm">
                <i class="fa-solid fa-heart"></i> Donar
            </a>
        </nav>
    </div>

    <div class="flex flex-col gap-4 p-8 border-t border-gray-100 mb-6 font-sans">
        <?php if (isset($_SESSION['usuario'])): ?>
            <a href="../vista/perfil_usuario.php" class="flex items-center gap-4 mb-4 p-2 bg-gray-50 rounded-xl">
                <div class="w-12 h-12 rounded-full border-2 border-[#D2691E] overflow-hidden">
                    <img src="../assets/imagenes/<?php echo !empty($_SESSION['foto_perfil']) ? $_SESSION['foto_perfil'] : 'avatar_default.png'; ?>" alt="Perfil" class="w-full h-full object-cover">
                </div>
                <span class="font-bold"><?php echo $_SESSION['usuario']; ?></span>
            </a>
            <a href="../Controlador/controlador_logout.php" class="w-full text-center py-4 bg-red-50 text-red-600 rounded-xl font-bold">Cerrar Sesión</a>
        <?php else: ?>
            <a href="../vista/login.php" class="w-full text-center py-4 border-2 border-[#1a4d2e] rounded-xl font-bold">Iniciar Sesión</a>
            <a href="../vista/registro.php" class="w-full py-4 bg-[#D2691E] rounded-xl text-white font-bold text-center">Registrarse</a>
        <?php endif; ?>
    </div>
</div>

<header class="bg-white w-full fixed top-0 left-0 z-50 shadow-md flex items-center justify-between px-4 md:px-12 h-20">

    <div class="flex items-center gap-2">
        <img class="w-20 h-20" src="../assets/imagenes/logo.png" alt="Logo">
        <h1 class="hidden lg:block text-xl font-bold text-[#1a4d2e]">Latido del lince</h1>
    </div>

    <ul class="hidden md:flex items-center gap-5">
        <li><a href="../index.php" class="text-[#297849] hover:text-[#1a4d2e] hover:font-bold hover:border-b-2 border-[#D2691E] pb-1">Inicio</a></li>
        <li><a href="../vista/lince.php" class="text-[#297849] hover:text-[#1a4d2e] hover:font-bold hover:border-b-2 border-[#D2691E] pb-1">El lince</a></li>
        <li><a href="../vista/quedada.php" class="text-[#297849] hover:text-[#1a4d2e] hover:font-bold hover:border-b-2 border-[#D2691E] pb-1">Quedadas</a></li>
        <li><a href="../vista/recompensas.php" class="text-[#297849] hover:text-[#1a4d2e] hover:font-bold hover:border-b-2 border-[#D2691E] pb-1">Recompensas</a></li>
    </ul>

    <div class="flex items-center gap-4">
        
        <?php if (isset($_SESSION['usuario'])): ?>
            <div class="hidden md:flex items-center gap-4">
                <a href="../vista/perfil_usuario.php" class="flex items-center gap-3 group">
                    <div class="text-right">
                        <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold">Mi Perfil</p>
                        <p class="text-sm font-bold text-[#1a4d2e] group-hover:text-[#D2691E] transition">
                            <?php echo $_SESSION['usuario']; ?>
                        </p>
                    </div>
                    <div class="w-10 h-10 rounded-full border-2 border-[#D2691E] overflow-hidden group-hover:scale-105 transition-transform shadow-sm">
                        <img src="../assets/imagenes/<?php echo !empty($_SESSION['foto_perfil']) ? $_SESSION['foto_perfil'] : 'avatar_default.png'; ?>" alt="Perfil" class="w-full h-full object-cover">
                    </div>
                </a>
                
                <div class="h-6 w-[1px] bg-gray-200 mx-1"></div>
                
                <a href="../vista/donar.php" class="flex items-center gap-2 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold uppercase tracking-wider rounded-lg transition shadow-sm">
                    <i class="fa-solid fa-heart animate-pulse"></i> Donar
                </a>

                <div class="h-6 w-[1px] bg-gray-200 mx-1"></div>

                <a href="../Controlador/controlador_logout.php" class="flex items-center gap-2 px-3 py-2 text-gray-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition" title="Cerrar Sesión">
                    <span class="text-xs font-bold uppercase tracking-tight hidden lg:block">Salir</span>
                    <i class="fa-solid fa-right-from-bracket text-lg"></i>
                </a>
            </div> 

        <?php else: ?>
            <div class="hidden md:flex items-center gap-5">
                
                <a href="../vista/donar.php" class="text-amber-600 font-bold text-sm hover:text-amber-700 flex items-center gap-1.5 transition-colors mr-2">
                    <i class="fa-solid fa-heart"></i> Donar
                </a>

                <a href="../vista/login.php" class="border-2 border-[#1a4d2e] px-4 py-2 rounded-lg text-sm font-semibold text-[#1a4d2e] hover:bg-[#1a4d2e] hover:text-white transition duration-500">
                    Iniciar Sesión
                </a>
                
                <a href="../vista/registro.php" class="bg-[#D2691E] px-4 py-2 rounded-lg text-white text-sm font-semibold hover:opacity-90 transition shadow-sm">
                    Registrarse
                </a>
            </div>
        <?php endif; ?>

        <button onclick="toggleMenu()" class="md:hidden p-2 border-2 border-[#1a4d2e] rounded-md text-[#1a4d2e]">
            <i class="fa-solid fa-bars h-6 w-6 flex items-center justify-center"></i>
        </button>
    </div>
</header>

<script>
    function toggleMenu() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    }
</script>