<?php
// página de registro: formulario para crear una nueva cuenta de usuario
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Registro</title>
</head>
<body>
    <!-- layout de dos columnas: imagen a la izquierda y formulario a la derecha -->
    <section class="flex items-stretch text-white">

        <!-- columna izquierda: solo visible en pantallas grandes, muestra el logo de fondo -->
        <div class="lg:flex w-1/2 hidden bg-no-repeat bg-cover bg-center relative items-center justify-center" 
        style="background-image: url('../assets/imagenes/logo.png');">
        </div>

        <!-- columna derecha: contiene el formulario de registro -->
        <div class="relative lg:w-1/2 min-h-screen w-full flex items-center justify-center text-center md:px-16 px-0 z-0" style="background-color: #161616;">
            
            <!-- imagen de fondo para móviles cuando la columna izquierda está oculta -->
            <div class="absolute lg:hidden z-10 inset-0 bg-gray-500 bg-no-repeat bg-cover items-center" style="background-image: url(https://images.unsplash.com/photo-1577495508048-b635879837f1?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=675&q=80);">
                <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
            </div>

            <div class="w-full py-6 z-20">

                <!-- enlace de volver solo visible en pantallas grandes -->
                <div class="hidden lg:block text-left text-gray-400 hover:text-[#D2691E] mt-2">
                    <a href="../index.php" class="group inline-flex items-center gap-2">
                       🡨 Volver a la página principal
                    </a>
                </div>

                <h1 class="my-6 text-4xl md:text-5xl font-serif font-bold">
                    Unete a la <span class="text-[#D2691E]">Manada</span>
                </h1>

                <!-- formulario que envía los datos al controlador de registro -->
                <form action="../controlador/controlador_registro.php" class="sm:w-2/3 w-full px-4 lg:px-0 mx-auto" method="POST">

                    <!-- campo usuario: borde rojo si hay errores de validación -->
                    <div class="pb-2 pt-4">
                        <input type="text" name="usuario" id="usuario" placeholder="Usuario" required  
                            class="block w-full p-3 text-lg rounded-lg bg-black border <?= isset($_SESSION['errores']['usuario']) ? 'border-red-500' : 'border-white/10' ?> focus:border-[#D2691E] outline-none transition-all">
                        
                        <!-- mostramos los errores del campo usuario si los hay -->
                        <?php if(isset($_SESSION['errores']['usuario'])): ?>
                            <div class="flex items-center gap-2 mt-2 text-red-400 bg-red-400/10 p-2 rounded-md border border-red-400/20">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i>
                                <span class="text-xs font-medium">
                                    <?= implode(', ', $_SESSION['errores']['usuario']) ?>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- campo email: borde rojo si hay errores de validación -->
                    <div class="pb-2 pt-4">
                        <input type="email" name="email" id="email" placeholder="Email" required 
                            class="block w-full p-3 text-lg rounded-lg bg-black border <?= isset($_SESSION['errores']['email']) ? 'border-red-500' : 'border-white/10' ?> focus:border-[#D2691E] outline-none transition-all">
                        
                        <!-- mostramos los errores del campo email si los hay -->
                        <?php if(isset($_SESSION['errores']['email'])): ?>
                            <div class="flex items-center gap-2 mt-2 text-red-400 bg-red-400/10 p-2 rounded-md border border-red-400/20">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i>
                                <span class="text-xs font-medium">
                                    <?= implode(', ', $_SESSION['errores']['email']) ?>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- campo contraseña: borde rojo si hay errores de validación -->
                    <div class="pb-2 pt-4">
                        <input type="password" name="contraseña" id="contraseña" placeholder="Contraseña" required 
                            class="block w-full p-3 text-lg rounded-lg bg-black border <?= isset($_SESSION['errores']['contraseña']) ? 'border-red-500' : 'border-white/10' ?> focus:border-[#D2691E] outline-none transition-all">
                        
                        <!-- mostramos los errores del campo contraseña si los hay -->
                        <?php if(isset($_SESSION['errores']['contraseña'])): ?>
                            <div class="flex items-center gap-2 mt-2 text-red-400 bg-red-400/10 p-2 rounded-md border border-red-400/20">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i>
                                <span class="text-xs font-medium">
                                    <?= implode(', ', $_SESSION['errores']['contraseña']) ?>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php
                    // limpiamos los errores y datos de sesión una vez mostrados para que no persistan
                    if (isset($_SESSION['errores'])) {
                        unset($_SESSION['errores']);
                    }
                    if (isset($_SESSION['datos'])) {
                        unset($_SESSION['datos']);
                    }
                    ?>

                    <!-- enlace de volver solo visible en móviles -->
                    <div class="lg:hidden text-right text-gray-400 hover:text-[#D2691E] mt-2">
                        <a href="../index.php" class="group inline-flex items-center gap-2">
                           🡨 Volver a la página principal
                        </a>
                    </div>

                    <!-- botón de envío del formulario -->
                    <div class="px-4 pb-2 pt-8">
                        <button class="uppercase block w-full p-4 text-lg rounded-full bg-[#D2691E] hover:bg-[#b85c1a] focus:outline-none font-bold transition-all">
                            Registrarse
                        </button>
                    </div>

                    <!-- enlace para ir al login si el usuario ya tiene cuenta -->
                    <div class="mt-8 text-gray-400">
                        <span>¿Ya tienes cuenta?</span>
                        <a href="login.php" class="text-[#D2691E] font-bold hover:underline ml-2">Iniciar Sesión</a>
                    </div>

                </form>
            </div>
        </div>
    </section>
  
</body>
</html>