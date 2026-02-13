<!DOCTYPE html>
<html lang="es">
<head>
    
    <meta charset="UTF-8"> 
    
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    
    <!-- Script Tailwind CSS  -->
    <script src="https://cdn.tailwindcss.com"></script> 
    
    <!-- Lin para iconos-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Título de la página -->
    <title>Latido del Lince</title> 
</head>

<body class="min-h-screen flex flex-col font-sans">

<!--MENÚ MÓVIL-->
 <!--Hidden se pone para que no se vea el menu hasta que se pulse el boton con el script-->
<div id="mobile-menu" 
     class="hidden fixed inset-0 z-[100] flex-col justify-between font-serif text-[#1a4d2e] bg-white h-screen shadow-md">

    <!-- Parte superior del menú -->
    <div class="flex flex-col">
        <!-- Header del menú móvil -->
        <div class="flex items-center justify-between p-4 border-b border-gray-100">
            <!-- Logo -->
            <img class="w-10 h-10" src="../assets/imagenes/logo.png" alt="Logo">
            
            <!-- Botón cerrar menú -->
            <button onclick="toggleMenu()" class="text-[#1a4d2e] p-2 text-3xl">
                &times;
            </button>
        </div>

        <!-- Navegación del menú móvil -->
        <nav class="flex flex-col gap-6 p-8 text-lg items-start">
            <a href="../index.php" class="hover:text-[#D2691E]">Inicio</a>
            <a href="../vista/lince.php" class="hover:text-[#D2691E]">El Lince</a>
            <a href="../vista/quedada.php" class="hover:text-[#D2691E]">Quedadas</a>
            <a href="../vista/recompensas.php" class="hover:text-[#D2691E]">Recompensas</a>
        </nav>
    </div>

    <!-- Botones de login y registro -->
    <div class="flex flex-col gap-4 p-8 border-t border-gray-100 mb-6">
        <a href="../vista/login.php" 
           class="w-full text-center py-4 border-2 border-[#1a4d2e] rounded-xl font-bold hover:bg-[#1a4d2e] hover:text-white transition">
           Iniciar Sesión
        </a>

        <a href="registro.php" 
           class="w-full py-4 bg-[#D2691E] rounded-xl text-white font-bold text-center hover:opacity-90 transition">
           Registrarse 
        </a>
    </div>
</div>

<!-- ================= Cabezera ================= -->
<header class="bg-white w-full fixed top-0 left-0 z-50 shadow-md flex items-center justify-between px-4 md:px-12 h-20">

    <!-- Logo y nombre -->
    <div class="flex items-center gap-2">
        <img class="w-16 h-16" src="../assets/imagenes/logo.png" alt="Logo">
        <h1 class="hidden lg:block text-xl font-bold text-[#1a4d2e]">
            Latido del lince
        </h1>
    </div>

    <!-- Menú de navegación (ordenador) -->
    <ul class="hidden md:flex items-center gap-5 text-[#e90000]">
        <li><a href="../index.php" class=" text-[#297849] hover:text-[#1a4d2e] hover:font-bold hover:transition-all hover:border-b-2 border-[#D2691E] pb-1">Inicio</a></li>
        <li><a href="../vista/lince.php" class="text-[#297849] hover:text-[#1a4d2e] hover:font-bold hover:transition-all hover:border-b-2 border-[#D2691E] pb-1">El lince</a></li>
        <li><a href="../vista/quedada.php" class="text-[#297849] hover:text-[#1a4d2e] hover:font-bold hover:transition-all hover:border-b-2 border-[#D2691E] pb-1">Quedadas</a></li>
        <li><a href="../vista/recompensas.php" class="text-[#297849] hover:text-[#1a4d2e] hover:font-bold hover:transition-all hover:border-b-2 border-[#D2691E] pb-1">Recompensas</a></li>
    </ul>

    <!-- Botones y menú hamburguesa -->
    <div class="flex items-center gap-4">

        <!-- Botones login/registro (ordenador) -->
        <div class="hidden md:flex items-center gap-2">
            <a href="../vista/login.php" 
               class="border-2 border-[#1a4d2e] px-4 py-2 rounded-lg text-sm font-semibold hover:bg-[#1a4d2e] hover:text-white transition">
               Iniciar Sesión
            </a>

            <a href="/ONG/vista/registro.php" 
               class="bg-[#D2691E] px-4 py-2 rounded-lg text-white text-sm font-semibold hover:opacity-90 transition">
               Registrarse
            </a>
        </div>

        <!-- Botón menú (móvil) -->
        <button onclick="toggleMenu()" 
                class="md:hidden p-2 border-2 border-[#1a4d2e] rounded-md text-[#1a4d2e]">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>
</header>

<!--SCRIPT MENÚ MÓVIL-->
<script>
    // Función para mostrar u ocultar el menú móvil
    function toggleMenu() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    }
</script>

</body>
</html>
