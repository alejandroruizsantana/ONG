<?php
// vista del perfil de usuario, espera que el controlador le pase $usuario_datos
if (!isset($usuario_datos)) {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    header('Location: ../Controlador/controlador_perfil.php');
    exit();
}

// si el controlador no pasa estas variables las inicializamos a 0 para evitar errores
$total_quedadas_pendientes = $total_quedadas_pendientes ?? 0;
$total_donado = $total_donado ?? 0;
$proximas_quedadas = $proximas_quedadas ?? [];

include '../partes/header.php';
?>

<main class="flex-grow bg-gray-50 pt-24 pb-24">
    <div class="max-w-5xl mx-auto px-4">
        
        <!-- cabecera del perfil: banner verde, foto y nombre del usuario -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-8">
            <!-- franja verde decorativa de fondo -->
            <div class="h-32 bg-[#1a4d2e]"></div>
            <div class="px-8 pb-8">
                <div class="relative flex flex-col md:flex-row items-center md:items-end -mt-16 gap-6">
                    <!-- foto de perfil tomada de la sesión -->
                    <div class="w-32 h-32 rounded-full border-4 border-white overflow-hidden shadow-lg bg-white">
                        <img src="../assets/imagenes/<?php echo $_SESSION['foto_perfil']; ?>" alt="Perfil" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-grow text-center md:text-left mb-2">
                        <!-- nombre de usuario y badge de rol -->
                        <h2 class="text-3xl font-serif font-bold text-[#1a4d2e]"><?php echo htmlspecialchars($_SESSION['usuario']); ?></h2>
                        <p class="text-gray-500">
                            <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-0.5 rounded-full uppercase">
                                <?php echo $_SESSION['rol']; ?>
                            </span>
                        </p>
                    </div>
                    <!-- botón que lleva al formulario de edición de perfil -->
                    <button class="mb-2 bg-white border border-gray-300 px-4 py-2 rounded-xl text-sm font-bold hover:bg-gray-50 transition">
                        <i class="fa-solid fa-pen-to-square mr-2"></i> <a href="../Controlador/controlador_editar_usuario.php">Editar Perfil</a>
                    </button>
                </div>
            </div>
        </div>

        <!-- layout principal: columna izquierda con estadísticas y columna derecha con quedadas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- columna izquierda: actividad total, medallas y botón de logout -->
            <div class="md:col-span-1 space-y-8">

                <!-- tarjeta con el resumen de quedadas pendientes y total donado -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                    <h4 class="font-bold text-[#1a4d2e] mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-chart-line text-[#D2691E]"></i> Mi Actividad Total
                    </h4>
                    
                    <div class="grid grid-cols-1 gap-4">
                        <!-- stat: número de quedadas futuras en las que está inscrito -->
                        <div class="p-4 bg-orange-50 rounded-2xl border border-orange-100">
                            <p class="text-xs text-orange-600 font-bold uppercase mb-1">Quedadas Pendientes</p>
                            <p class="text-3xl font-bold text-[#D2691E]"><?php echo $total_quedadas_pendientes; ?></p>
                        </div>
                        
                        <!-- stat: suma total de dinero donado por el usuario -->
                        <div class="p-4 bg-green-50 rounded-2xl border border-green-100">
                            <p class="text-xs text-green-600 font-bold uppercase mb-1">Total Donaciones</p>
                            <p class="text-3xl font-bold text-[#1a4d2e]"><?php echo $total_donado; ?>€</p>
                        </div>
                    </div>
                </div>

                <?php
                    // calculamos si el usuario ha alcanzado cada nivel de medalla según lo donado
                    $nivel_bronce = 10;
                    $nivel_plata = 50;
                    $nivel_oro = 100;
                    $bronce_completado = $total_donado >= $nivel_bronce;
                    $plata_completado = $total_donado >= $nivel_plata;
                    $oro_completado = $total_donado >= $nivel_oro;
                ?>

                <!-- tarjeta de medallas: se marca en verde si el usuario ha superado el umbral -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                    <h4 class="font-bold text-[#1a4d2e] mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-medal text-[#D2691E]"></i> Mis Medallas
                    </h4>
                    <div class="space-y-4">

                        <!-- medalla bronce: se desbloquea con 10€ donados -->
                        <div class="p-4 rounded-3xl border <?php echo $bronce_completado ? 'border-emerald-300 bg-emerald-50' : 'border-gray-200 bg-white'; ?> flex items-center justify-between">
                            <div>
                                <p class="font-semibold text-sm text-[#1a4d2e]">Bronce</p>
                                <p class="text-xs text-gray-500">Desde 10€</p>
                            </div>
                            <?php if ($bronce_completado): ?>
                                <span class="text-emerald-700 font-bold">✔</span>
                            <?php endif; ?>
                        </div>

                        <!-- medalla plata: se desbloquea con 50€ donados -->
                        <div class="p-4 rounded-3xl border <?php echo $plata_completado ? 'border-emerald-300 bg-emerald-50' : 'border-gray-200 bg-white'; ?> flex items-center justify-between">
                            <div>
                                <p class="font-semibold text-sm text-[#1a4d2e]">Plata</p>
                                <p class="text-xs text-gray-500">Desde 50€</p>
                            </div>
                            <?php if ($plata_completado): ?>
                                <span class="text-emerald-700 font-bold">✔</span>
                            <?php endif; ?>
                        </div>

                        <!-- medalla oro: se desbloquea con 100€ donados -->
                        <div class="p-4 rounded-3xl border <?php echo $oro_completado ? 'border-emerald-300 bg-emerald-50' : 'border-gray-200 bg-white'; ?> flex items-center justify-between">
                            <div>
                                <p class="font-semibold text-sm text-[#1a4d2e]">Oro</p>
                                <p class="text-xs text-gray-500">Desde 100€</p>
                            </div>
                            <?php if ($oro_completado): ?>
                                <span class="text-emerald-700 font-bold">✔</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- botón de cerrar sesión: enlaza al controlador de logout -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 text-center">
                    <a href="../Controlador/controlador_logout.php" class="text-red-500 font-bold text-sm hover:text-red-700 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-power-off"></i> Cerrar Sesión Segura
                    </a>
                </div>
            </div>

            <!-- columna derecha: próximas quedadas en las que está inscrito el usuario -->
            <div class="md:col-span-2 space-y-8">

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-serif font-bold text-[#1a4d2e]">Próximas Quedadas</h3>
                        <a href="../vista/quedadas.php" class="text-xs font-bold text-[#D2691E] uppercase hover:underline">Buscar más</a>
                    </div>

                    <?php if (!empty($proximas_quedadas)): ?>
                        <!-- listado de quedadas futuras del usuario -->
                        <div class="space-y-4">
                            <?php foreach ($proximas_quedadas as $quedada): ?>
                                <!-- tarjeta de cada quedada con título, fecha, hora, ubicación y descripción -->
                                <div class="p-4 bg-slate-50 rounded-3xl border border-gray-100 text-left">
                                    <h4 class="font-semibold text-[#1a4d2e] mb-2"><?php echo htmlspecialchars($quedada['titulo']); ?></h4>
                                    <p class="text-sm text-gray-500 mb-2">
                                        <?php echo htmlspecialchars($quedada['fecha']); ?> · <?php echo htmlspecialchars($quedada['hora_inicio']); ?> - <?php echo htmlspecialchars($quedada['hora_fin']); ?>
                                    </p>
                                    <p class="text-sm text-gray-600 mb-3">
                                        <?php echo htmlspecialchars($quedada['ubicacion']); ?>, <?php echo htmlspecialchars($quedada['provincia']); ?>
                                    </p>
                                    <p class="text-sm text-gray-500"><?php echo htmlspecialchars($quedada['descripcion']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <!-- mensaje vacío si el usuario no tiene quedadas próximas -->
                        <div class="border-2 border-dashed border-gray-100 rounded-2xl py-8 text-center">
                            <p class="text-gray-400 text-sm">No tienes inscripciones activas actualmente.</p>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</main>

<?php include '../partes/footer.php'; ?>