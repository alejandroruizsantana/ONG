<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Registro</title>
</head>
<body>
    <section class="min-h-screen flex items-stretch text-white">
        <div class="lg:flex w-1/2 hidden bg-gray-500 bg-no-repeat bg-cover relative items-center">
            <img src="../assets/imagenes/logo.png" alt="">
            <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
        </div>

        <div class="relative lg:w-1/2 min-h-screen w-full flex items-center justify-center text-center md:px-16 px-0 z-0" style="background-color: #161616;">
            <div class="absolute  lg:hidden z-10 inset-0 bg-gray-500 bg-no-repeat bg-cover items-center" style="background-image: url(https://images.unsplash.com/photo-1577495508048-b635879837f1?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=675&q=80);">
                <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
            </div>

            <div class="w-full py-6 z-20">
                <div class="hidden lg:block text-left text-gray-400 hover:text-[#D2691E] mt-2">
                        <a href="../index.php" class="group inline-flex items-center gap-2">
                           🡨 Volver a la página principal
                        </a>
                    </div>
                <h1 class="my-6 text-4xl md:text-5xl font-serif font-bold">
                    Unete a la  <span class="text-[#D2691E]">Manada</span>
                </h1>
              
                <form action="../controlador/controlador_registro.php" class="sm:w-2/3 w-full px-4 lg:px-0 mx-auto" method="POST">
                    <div class="pb-2 pt-4">
                        <input type="text" name="usuario" id="usuario" placeholder="Usuario" required  class="block  w-full p-4 text-lg rounded-lg bg-black border border-white/10 focus:border-[#D2691E] outline-none ">
                        <ul>
                            <?php if(isset($_SESSION['errores']['usuario'])): ?>
                                <?php foreach($_SESSION['errores']['usuario'] as $error): ?>
                                    <li class="text-red-500 text-sm"><?= $error ?></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <div class="pb-2 pt-4">
                        <input class="block w-full p-4 text-lg rounded-lg bg-black border border-white/10 focus:border-[#D2691E] outline-none" type="email" name="email" id="email" placeholder="Email" required  >
                        <ul>
                            <?php if(isset($_SESSION['errores']['email'])): ?>
                                <?php foreach($_SESSION['errores']['email'] as $error): ?>
                                    <li class="text-red-500 text-sm"><?= $error ?></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <div class="pb-2 pt-4">
                        <input class="block w-full p-4 text-lg rounded-lg bg-black border border-white/10 focus:border-[#D2691E] outline-none" type="password" name="contraseña" id="contraseña" placeholder="Contraseña" required  >
                         <ul>
                            <?php if(isset($_SESSION['errores']['contraseña'])): ?>
                                <?php foreach($_SESSION['errores']['contraseña'] as $error): ?>
                                    <li class="text-red-500 text-sm "><?= $error ?></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <?php
                    if (isset($_SESSION['errores'])) {
                        unset($_SESSION['errores']);
                    }
                    if (isset($_SESSION['datos'])) {
                        unset($_SESSION['datos']);
                    }
                    ?>

                 

                   

                    


                    <div class="lg:hidden text-right text-gray-400 hover:text-[#D2691E] mt-2">
                        <a href="../index.php" class="group inline-flex items-center gap-2">
                           🡨 Volver a la página principal
                        </a>
                    </div>

                    <div class="px-4 pb-2 pt-8">
                        <button class="uppercase block w-full p-4 text-lg rounded-full bg-[#D2691E] hover:bg-[#b85c1a] focus:outline-none font-bold transition-all">
                            Registrarse
                        </button>
                    </div>

                    

                    <div class="mt-8 text-gray-400">
                        <span>¿Ya tienes cuenta?</span>
                        <a href="login.php" class="text-[#D2691E] font-bold hover:underline ml-2">Iniciar Sesión</a>
                    </div>

                   
                </form>
<?php
if (isset($login_correcto)&& $login_correcto){
    echo "Hola";
}
?>
                
            </div>
        </div>
    </section>
  
</body>
</html>

