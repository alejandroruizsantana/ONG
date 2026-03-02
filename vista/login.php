<?php 
session_start(); 
// Recuperamos el nombre si existe la cookie
$usuario_recordado = $_COOKIE['recordar_usuario'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Login | La Manada</title>
</head>
<body>
    <section class="min-h-screen flex items-stretch text-white">
        <div class="lg:flex w-1/2 hidden bg-no-repeat bg-cover bg-center relative items-center justify-center" 
             style="background-image: url('../assets/imagenes/logo.png');">
        </div>

        <div class="lg:w-1/2 w-full flex items-center justify-center text-center md:px-16 px-0 z-0" style="background-color: #161616;">
            
            <div class="w-full py-6 z-20">
                <div class="hidden lg:block text-left text-gray-400 hover:text-[#D2691E] mt-2 mb-8 ml-10">
                    <a href="../index.php" class="group inline-flex items-center gap-2">
                       🡨 Volver a la página principal
                    </a>
                </div>

                <h1 class="my-6 text-4xl md:text-5xl font-serif font-bold">
                    Bienvenido de <span class="text-[#D2691E]">Nuevo</span>
                </h1>

                <?php if(isset($_SESSION['errores_login'])): ?>
                    <div class="max-w-md mx-auto mb-6 bg-red-500/10 border border-red-500/50 p-4 rounded-xl text-red-400 flex items-center gap-3 justify-center">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <p class="text-sm font-medium"><?= $_SESSION['errores_login'] ?></p>
                    </div>
                    <?php unset($_SESSION['errores_login']); ?>
                <?php endif; ?>
              
                <form action="../Controlador/controlador_login.php" method="POST" class="sm:w-2/3 w-full px-4 lg:px-0 mx-auto">
                    
                    <div class="pb-2 pt-4">
                        <input type="text" name="usuario" id="usuario" 
                               value="<?= $usuario_recordado ?>"
                               placeholder="Usuario" required 
                               class="block w-full p-3 text-lg rounded-lg bg-black border <?= isset($_SESSION['errores_campos']['usuario']) ? 'border-red-500' : 'border-white/10' ?> focus:border-[#D2691E] outline-none transition-all">
                        
                        <?php if(isset($_SESSION['errores_campos']['usuario'])): ?>
                            <div class="flex items-center gap-2 mt-2 text-red-400 bg-red-400/10 p-2 rounded-md border border-red-400/20 text-left">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i>
                                <span class="text-xs font-medium"><?= implode(', ', $_SESSION['errores_campos']['usuario']) ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="pb-2 pt-4">
                        <input class="block w-full p-3 text-lg rounded-lg bg-black border <?= isset($_SESSION['errores_campos']['contrasena']) ? 'border-red-500' : 'border-white/10' ?> focus:border-[#D2691E] outline-none transition-all" 
                               type="password" name="contrasena" id="contrasena" placeholder="Contraseña" required>
                        
                        <?php if(isset($_SESSION['errores_campos']['contrasena'])): ?>
                            <div class="flex items-center gap-2 mt-2 text-red-400 bg-red-400/10 p-2 rounded-md border border-red-400/20 text-left">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i>
                                <span class="text-xs font-medium"><?= implode(', ', $_SESSION['errores_campos']['contrasena']) ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php unset($_SESSION['errores_campos']); // Limpiamos errores de campos ?>

                    <div class="flex justify-end mt-4">
                        <label class="inline-flex items-center gap-2 cursor-pointer text-gray-400 hover:text-[#D2691E] text-sm">
                            <input type="checkbox" name="recordar" id="recordar" <?= $usuario_recordado ? 'checked' : '' ?>
                                   class="w-4 h-4 rounded border-gray-300 text-[#D2691E] focus:ring-[#D2691E] focus:ring-2">
                            <span>Recordar nombre de usuario</span>
                        </label>
                    </div>

                    <div class="px-4 pb-2 pt-8">
                        <button type="submit" class="uppercase block w-full p-4 text-lg rounded-full bg-[#D2691E] hover:bg-[#b85c1a] focus:outline-none font-bold transition-all shadow-lg shadow-orange-900/20">
                            Iniciar Sesión
                        </button>
                    </div>

                    <div class="mt-8 text-gray-400">
                        <span>¿No tienes cuenta?</span>
                        <a href="registro.php" class="text-[#D2691E] font-bold hover:underline ml-2">Regístrate aquí</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>