<?php


// Esta vista debe ser provista por ../Controlador/controlador_perfil.php
if (!isset($usuario_datos)) {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    header('Location: ../Controlador/controlador_perfil.php');
    exit();
}

//Datos ejemplo (Despues hacer en la base de datos)
$total_quedadas = 3; 
$total_donado = 25;

include '../partes/header.php';
?>

<main class="flex-grow bg-gray-50 pt-24 pb-24">
    <div class="max-w-5xl mx-auto px-4">
        
        <!-- CABECERA DEL PERFIL -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-8">
            <div class="h-32 bg-[#1a4d2e]"></div>
            <div class="px-8 pb-8">
                <div class="relative flex flex-col md:flex-row items-center md:items-end -mt-16 gap-6">
                    <div class="w-32 h-32 rounded-full border-4 border-white overflow-hidden shadow-lg bg-white">
                        <img src="../assets/imagenes/<?php echo $_SESSION['foto_perfil']; ?>" alt="Perfil" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-grow text-center md:text-left mb-2">
                        <h2 class="text-3xl font-serif font-bold text-[#1a4d2e]"><?php echo htmlspecialchars($_SESSION['usuario']); ?></h2>
                        <p class="text-gray-500">
                            <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-0.5 rounded-full uppercase">
                                <?php echo $_SESSION['rol']; ?>
                            </span>
                        </p>
                    </div>
                    <button class="mb-2 bg-white border border-gray-300 px-4 py-2 rounded-xl text-sm font-bold hover:bg-gray-50 transition">
                        <i class="fa-solid fa-pen-to-square mr-2"></i> <a href="../Controlador/controlador_editar_usuario.php">Editar Perfil</a>
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- COLUMNA IZQUIERDA: RESUMEN DE LOGROS -->
            <div class="md:col-span-1 space-y-8">
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                    <h4 class="font-bold text-[#1a4d2e] mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-chart-line text-[#D2691E]"></i> Mi Actividad Total
                    </h4>
                    
                    <div class="grid grid-cols-1 gap-4">
                        <div class="p-4 bg-orange-50 rounded-2xl border border-orange-100">
                            <p class="text-xs text-orange-600 font-bold uppercase mb-1">Quedadas Asistidas</p>
                            <p class="text-3xl font-bold text-[#D2691E]"><?php echo $total_quedadas; ?></p>
                        </div>
                        
                        <div class="p-4 bg-green-50 rounded-2xl border border-green-100">
                            <p class="text-xs text-green-600 font-bold uppercase mb-1">Total Donaciones</p>
                            <p class="text-3xl font-bold text-[#1a4d2e]"><?php echo $total_donado; ?>€</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 text-center">
                    <a href="../Controlador/controlador_logout.php" class="text-red-500 font-bold text-sm hover:text-red-700 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-power-off"></i> Cerrar Sesión Segura
                    </a>
                </div>
            </div>

            <!-- COLUMNA DERECHA: RECOMPENSAS Y EVENTOS -->
            <div class="md:col-span-2 space-y-8">
                
                

                <!-- MIS INSCRIPCIONES -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-serif font-bold text-[#1a4d2e]">Próximas Quedadas</h3>
                        <a href="quedada.php" class="text-xs font-bold text-[#D2691E] uppercase hover:underline">Buscar más</a>
                    </div>

                    <div class="border-2 border-dashed border-gray-100 rounded-2xl py-8 text-center">
                        <p class="text-gray-400 text-sm">No tienes inscripciones activas actualmente.</p>
                    </div>
                </div>

            </div> <!-- Fin col-2 -->
        </div> <!-- Fin grid -->
    </div> <!-- Fin container -->
</main>

<?php include '../partes/footer.php'; ?>