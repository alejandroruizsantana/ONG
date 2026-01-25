<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Header</title>
</head>
<body>
   <header class="bg-white w-full fixed top-0 left-0 z-50 shadow-md  flex items-center justify-between ">

   <!--Logo-->
   <div class="flex items-center gap-0 bg ">
    <img class="w-28 h-27" src="../assets/imagenes/logo.png" alt="Logo de la ONG">
    <h1 class="text-xl font-bold font-serif">Latido del lince</h1>
    </div>

    <!--Navegador-->
    <ul class=" flex  items-center gap-10 font-serif text-lg text-emerald-700 ">
        <li><a href="index.php" class="hover:text-[#1a4d2e] border-b-2 border-transparent hover:border-[#D2691E] pb-1 transition-all duration-300 ">Inicio</a></li>
        <li><a href="lince.php" class="hover:text-[#1a4d2e] border-b-2 border-transparent hover:border-[#D2691E] pb-1 transition-all duration-300">El lince</a></li>
        <li><a href="quedada.php" class="hover:text-[#1a4d2e] border-b-2 border-transparent hover:border-[#D2691E] pb-1 transition-all duration-300">Quedadas</a></li>
        <li><a href="recompensas.php" class="hover:text-[#1a4d2e] border-b-2 border-transparent hover:border-[#D2691E] pb-1 transition-all duration-300">Recompensas</a></li>
        <li><a href="donaciones.php" class="hover:text-[#1a4d2e] border-b-2 border-transparent hover:border-[#D2691E] pb-1 transition-all duration-300">Donaciones</a></li>

    </ul>

    <!--Registro y login-->
    <div class=" flex items-center gap-8  mr-20">
        <button class= "border-2 border-[#1a4d2e] px-8 py-3 rounded-lg text-emerald-700 hover:bg-[#1a4d2e] hover:text-white "><a href="login.php">Iniciar Sesión</a></button>
        <button class="border-2 px-8 py-3 rounded-lg  border-[#D2691E] bg-[#D2691E] text-white hover:opacity-85" ><a href="registro.php"> Registrarse ♥</a></button>
    </div>
   </header>
</body>
</html>