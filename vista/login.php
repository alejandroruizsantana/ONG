<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>
<body>
    <section class="min-h-screen flex items-stretch text-white">
        <div class="lg:flex w-1/2 hidden bg-gray-500 bg-no-repeat bg-cover relative items-center">
            <img src="../assets/imagenes/logo.png" alt="">
            <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
        </div>

        <div class="lg:w-1/2 w-full flex items-center justify-center text-center md:px-16 px-0 z-0" style="background-color: #161616;">
            <div class="absolute lg:hidden z-10 inset-0 bg-gray-500 bg-no-repeat bg-cover items-center" style="background-image: url(https://images.unsplash.com/photo-1577495508048-b635879837f1?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=675&q=80);">
                <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
            </div>

            <div class="w-full py-6 z-20">
                <h1 class="my-6 text-4xl md:text-5xl font-serif font-bold">
                    Bienvenido de <span class="text-[#D2691E]">Nuevo</span>
                </h1>
              
                <form action="" class="sm:w-2/3 w-full px-4 lg:px-0 mx-auto">
                    <div class="pb-2 pt-4">
                        <input type="email" name="email" id="email" placeholder="Email" class="block  w-full p-4 text-lg rounded-lg bg-black border border-white/10 focus:border-[#D2691E] outline-none">
                    </div>
                    <div class="pb-2 pt-4">
                        <input class="block w-full p-4 text-lg rounded-lg bg-black border border-white/10 focus:border-[#D2691E] outline-none" type="password" name="password" id="password" placeholder="Contraseña">
                    </div>

                    

                    <div class="text-right text-gray-400 hover:text-[#D2691E] mt-2">
                        <a href="../index.php" class="group inline-flex items-center gap-2">
                           🡨 Volver a la página principal
                        </a>
                    </div>

                    <div class="px-4 pb-2 pt-8">
                        <button class="uppercase block w-full p-4 text-lg rounded-full bg-[#D2691E] hover:bg-[#b85c1a] focus:outline-none font-bold transition-all">
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