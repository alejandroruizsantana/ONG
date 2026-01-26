<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <script src="https://cdn.tailwindcss.com"></script> 
    <title>Header</title> 
</head>
<body>

<!-- Cabecera principal -->
<header class="bg-white w-full fixed top-0 left-0 z-50 shadow-md flex items-center justify-between pl-0 pr-4 md:px-12 h-20">
    
    <!-- Menú móvil oculto -->
    <div id="mobile-menu" class="hidden fixed inset-0 z-[100] flex-col justify-between font-serif text-[#1a4d2e] bg-white h-screen shadow-md">
    
        <div class="flex flex-col">
            <!-- Logo y botón de cerrar menú -->
            <div class="flex items-center justify-between p-4 border-b border-gray-100">
                <img class="w-10 h-10" src="../assets/imagenes/logo.png" alt="Logo"> <!-- Logo -->
                <button onclick="toggleMenu()" class="text-[#1a4d2e] p-2 focus:outline-none text-3xl">
                    &times; <!-- Símbolo de "cerrar" -->
                </button>
            </div>

            <!-- Navegación del menú móvil -->
            <nav class="flex flex-col gap-6 p-8 text-lg items-start">
                <a href="index.php" class="hover:text-[#D2691E] transition-colors">Inicio</a>
                <a href="lince.php" class="hover:text-[#D2691E] transition-colors">El Lince</a>
                <a href="quedada.php" class="hover:text-[#D2691E] transition-colors">Quedadas</a>
                <a href="recompensas.php" class="hover:text-[#D2691E] transition-colors">Recompensas</a>
                <a href="donaciones.php" class="hover:text-[#D2691E] transition-colors">Donar</a>
            </nav>
        </div>

        <!-- Botones de Login y Registro en móvil -->
        <div class="flex flex-col gap-4 p-8 border-t border-gray-100 mb-6">
            <a href="login.php" class="w-full text-center py-4 border-2 border-[#1a4d2e] rounded-xl text-[#1a4d2e] font-bold hover:bg-[#1a4d2e] hover:text-white transition">
                Iniciar Sesión
            </a>
            <a href="registro.php" class="w-full py-4 bg-[#D2691E] rounded-xl text-white font-bold flex items-center justify-center gap-2 hover:opacity-90 transition shadow-sm">
                <span class="text-xl ">&#9825;</span> Registrarse
            </a>
        </div>
    </div>

<!-- Cabecera de escritorio -->
<header class="bg-white w-full fixed top-0 left-0 z-50 shadow-md flex items-center justify-between px-4 md:px-12 h-20">

    <!-- Logo y título -->
    <div class="flex items-center gap-2">
        <img class="w-20 h-20" src="../assets/imagenes/logo.png" alt="Logo"> <!-- Logo -->
        <h1 class="hidden lg:block text-xl font-bold font-serif text-[#1a4d2e]">Latido del lince</h1> <!-- Titulo -->
    </div>

    <!-- Menú de navegación de escritorio -->
    <ul class="hidden md:flex items-center gap-5 font-serif text-[#1a4d2e]">
        <li><a href="index.php" class="hover:border-b-2 border-[#D2691E] pb-1 transition-all">Inicio</a></li>
        <li><a href="lince.php" class="hover:border-b-2 border-[#D2691E] pb-1 transition-all">El lince</a></li>
        <li><a href="quedada.php" class="hover:border-b-2 border-[#D2691E] pb-1 transition-all">Quedadas</a></li>
        <li><a href="recompensas.php" class="hover:border-b-2 border-[#D2691E] pb-1 transition-all">Recompensas</a></li>
    </ul>

    <!-- Botones de inicio de sesión y registro en escritorio y botón de menú móvil -->
    <div class="flex items-center gap-7">
        <div class="hidden md:flex items-center gap-2">
            <a href="login.php" class="border-2 border-[#1a4d2e] px-4 py-2 rounded-lg text-[#1a4d2e] font-semibold hover:bg-[#1a4d2e] hover:text-white transition">Iniciar Sesión</a>
            <a href="registro.php" class="bg-[#D2691E] px-4 py-2 rounded-lg text-white font-semibold flex items-center gap-2 hover:opacity-90 transition shadow-sm">
                <span class="text-lg">&#9825;</span> Registrarse
            </a>
        </div>

        <!-- Botón de menú  en móvil -->
        <button onclick="toggleMenu()" class="md:hidden p-2 border-2 border-[#1a4d2e] rounded-md text-[#1a4d2e]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /> <!-- Icono de 3 líneas -->
            </svg>
        </button>
    </div>

</header>

<!-- Script para mostrar/ocultar el menú móvil -->
<script>
function toggleMenu() {
    const menu = document.getElementById('mobile-menu'); // Selecciona el menú móvil
    menu.classList.toggle('hidden'); // Alterna la clase 'hidden' para mostrar u ocultar
}
</script>

</body>
</html>
