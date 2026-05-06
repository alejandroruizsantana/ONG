<?php 
/* Incluimos conexión, modelo y header */
include_once '../conexion/conexion_base_datos.php';            
include_once '../Modelo/modelo_quedadas.php';   

/* Obtenemos los datos de las quedas con una funcion del modelo */
$resultadoQuedadas = obtener_resultado_quedadas($conexion);

include '../Partes/header.php'; 
?>

<main class="flex-grow bg-[#f8f7f4]">

    <!-- Cabezera -->
    <section class="bg-[#1a4d2e] pt-32 pb-20 px-4 text-center text-white">
        <div class="max-w-4xl mx-auto">
            <!-- Etiqueta decorativa -->
            <span class="bg-[#D2691E] text-white text-xs font-bold px-4 py-1.5 rounded-full uppercase mb-6 inline-block">Participa</span>
            <!-- Título -->
            <h1 class="text-5xl md:text-7xl font-serif font-bold mb-6">
                Quedadas de <span class="text-[#D2691E]">Limpieza</span>
            </h1>
            <!-- Descripción -->
            <p class="text-gray-200 text-lg md:text-xl max-w-3xl mx-auto mb-16">
                Únete a nuestros voluntarios y ayuda a mantener limpio el hábitat del lince ibérico. ¡Cada mano cuenta!
            </p>
        </div>
    </section>
    <!-- Fin de la cabezera -->


    <!-- Mensaje de éxito-->
    <?php if (isset($_SESSION['mensaje_exito'])): ?>
        <div class="max-w-7xl mx-auto mt-8 px-4">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-xl shadow-sm font-sans flex items-center gap-2">
                <i class="fa-solid fa-circle-check"></i>
                <span><?php echo $_SESSION['mensaje_exito']; ?></span>
            </div>
        </div>
        <?php unset($_SESSION['mensaje_exito']); ?>
    <?php endif; ?>

    <!-- Mensaje de error -->
    <?php if (isset($_SESSION['mensaje_error'])): ?>
        <div class="max-w-7xl mx-auto mt-8 px-4">
            <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 rounded-xl shadow-sm font-sans flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span><?php echo $_SESSION['mensaje_error']; ?></span>
            </div>
        </div>
        <?php unset($_SESSION['mensaje_error']); ?>
    <?php endif; ?>


    <!-- QUEDADAS -->
    <section class="py-16 px-4">
        <div class="max-w-7xl mx-auto">

            <!-- Seccion antes de las tarjetas -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-[#1a4d2e] mb-4">Próximos Eventos</h2>
                <p class="text-gray-500">Elige la quedada que mejor te venga y reserva tu plaza. ¡Las plazas son limitadas!</p>
            </div>

            <!-- Grid de tarjetas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                <!-- Tarjeta 1: Andújar -->
                <?php if ($resultadoQuedadas && $quedada = mysqli_fetch_assoc($resultadoQuedadas)): 
                    $porcentaje = ($quedada['plazas_totales'] > 0) ? round(($quedada['plazas_ocupadas'] / $quedada['plazas_totales']) * 100) : 0; ?>
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                        <div class="relative h-64 overflow-hidden">
                            <img src="../assets/imagenes/Andujar.jpg" alt="Andújar" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-gray-700 flex items-center gap-1">
                                <i class="fa-solid fa-users text-[#D2691E]"></i>
                                <?php echo $quedada['plazas_ocupadas'] . '/' . $quedada['plazas_totales']; ?>
                            </div>
                        </div>
                        <div class="p-8">
                            <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-4"><?php echo htmlspecialchars($quedada['titulo']); ?></h3>
                            <div class="space-y-3 mb-6 text-sm text-gray-500">
                                <div class="flex items-center gap-3"><i class="fa-regular fa-calendar text-[#D2691E]"></i><?php echo date("d M Y", strtotime($quedada['fecha'])); ?></div>
                                <div class="flex items-center gap-3"><i class="fa-regular fa-clock text-[#D2691E]"></i><?php echo date("H:i", strtotime($quedada['hora_inicio'])) . ' - ' . date("H:i", strtotime($quedada['hora_fin'])); ?></div>
                                <div class="flex items-center gap-3"><i class="fa-solid fa-location-dot text-[#D2691E]"></i><?php echo htmlspecialchars($quedada['ubicacion'] . ', ' . $quedada['provincia']); ?></div>
                            </div>
                            <p class="text-gray-600 text-sm mb-6 line-clamp-2"><?php echo htmlspecialchars($quedada['descripcion']); ?></p>
                            <div class="mb-6">
                                <div class="flex justify-between text-xs mb-2"><span class="text-gray-400 font-medium">Plazas ocupadas</span><span class="text-gray-400"><?php echo $porcentaje; ?>%</span></div>
                                <div class="w-full bg-gray-100 rounded-full h-2"><div class="bg-[#D2691E] h-full rounded-full" style="width: <?php echo $porcentaje; ?>%"></div></div>
                            </div>
                            <!--Si existe el usuario se podrá inscribir si no sale un enlace para registrarse o iniciar sesion -->
                            <?php if (isset($_SESSION['usuario'])): ?>
                                <form action="../Controlador/controlador_inscripcion.php" method="POST">
                                    <input type="hidden" name="id_quedada" value="<?php echo $quedada['id']; ?>">
                                    <button type="submit" class="w-full py-4 bg-[#D2691E] hover:bg-[#b85c1a] text-white text-center rounded-xl font-bold transition-colors">Apuntarme</button>
                                </form>
                            <?php else: ?>
                                <a href="login.php" class="block w-full py-4 border-2 border-[#1a4d2e] text-[#1a4d2e] hover:bg-[#1a4d2e] hover:text-white text-center rounded-xl font-bold transition-all">Inicia sesión para apuntarte</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Tarjeta 2: Doñana -->
                <?php if ($resultadoQuedadas && $quedada = mysqli_fetch_assoc($resultadoQuedadas)): 
                    $porcentaje = ($quedada['plazas_totales'] > 0) ? round(($quedada['plazas_ocupadas'] / $quedada['plazas_totales']) * 100) : 0; ?>
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                        <div class="relative h-64 overflow-hidden">
                            <img src="../assets/imagenes/Doñana.jpg" alt="Doñana" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-gray-700 flex items-center gap-1">
                                <i class="fa-solid fa-users text-[#D2691E]"></i>
                                <?php echo $quedada['plazas_ocupadas'] . '/' . $quedada['plazas_totales']; ?>
                            </div>
                        </div>
                        <div class="p-8">
                            <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-4"><?php echo htmlspecialchars($quedada['titulo']); ?></h3>
                            <div class="space-y-3 mb-6 text-sm text-gray-500">
                                <div class="flex items-center gap-3"><i class="fa-regular fa-calendar text-[#D2691E]"></i><?php echo date("d M Y", strtotime($quedada['fecha'])); ?></div>
                                <div class="flex items-center gap-3"><i class="fa-regular fa-clock text-[#D2691E]"></i><?php echo date("H:i", strtotime($quedada['hora_inicio'])) . ' - ' . date("H:i", strtotime($quedada['hora_fin'])); ?></div>
                                <div class="flex items-center gap-3"><i class="fa-solid fa-location-dot text-[#D2691E]"></i><?php echo htmlspecialchars($quedada['ubicacion'] . ', ' . $quedada['provincia']); ?></div>
                            </div>
                            <p class="text-gray-600 text-sm mb-6 line-clamp-2"><?php echo htmlspecialchars($quedada['descripcion']); ?></p>
                            <div class="mb-6">
                                <div class="flex justify-between text-xs mb-2"><span class="text-gray-400 font-medium">Plazas ocupadas</span><span class="text-gray-400"><?php echo $porcentaje; ?>%</span></div>
                                <div class="w-full bg-gray-100 rounded-full h-2"><div class="bg-[#D2691E] h-full rounded-full" style="width: <?php echo $porcentaje; ?>%"></div></div>
                            </div>
                            <?php if (isset($_SESSION['usuario'])): ?>
                                <form action="../Controlador/controlador_inscripcion.php" method="POST">
                                    <input type="hidden" name="id_quedada" value="<?php echo $quedada['id']; ?>">
                                    <button type="submit" class="w-full py-4 bg-[#D2691E] hover:bg-[#b85c1a] text-white text-center rounded-xl font-bold transition-colors">Apuntarme</button>
                                </form>
                            <?php else: ?>
                                <a href="login.php" class="block w-full py-4 border-2 border-[#1a4d2e] text-[#1a4d2e] hover:bg-[#1a4d2e] hover:text-white text-center rounded-xl font-bold transition-all">Inicia sesión para apuntarte</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Tarjeta 3: Sierra Morena -->
                <?php if ($resultadoQuedadas && $quedada = mysqli_fetch_assoc($resultadoQuedadas)): 
                    $porcentaje = ($quedada['plazas_totales'] > 0) ? round(($quedada['plazas_ocupadas'] / $quedada['plazas_totales']) * 100) : 0; ?>
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                        <div class="relative h-64 overflow-hidden">
                            <img src="../assets/imagenes/Sierra_morena.jpg" alt="Sierra Morena" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-gray-700 flex items-center gap-1">
                                <i class="fa-solid fa-users text-[#D2691E]"></i>
                                <?php echo $quedada['plazas_ocupadas'] . '/' . $quedada['plazas_totales']; ?>
                            </div>
                        </div>
                        <div class="p-8">
                            <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-4"><?php echo htmlspecialchars($quedada['titulo']); ?></h3>
                            <div class="space-y-3 mb-6 text-sm text-gray-500">
                                <div class="flex items-center gap-3"><i class="fa-regular fa-calendar text-[#D2691E]"></i><?php echo date("d M Y", strtotime($quedada['fecha'])); ?></div>
                                <div class="flex items-center gap-3"><i class="fa-regular fa-clock text-[#D2691E]"></i><?php echo date("H:i", strtotime($quedada['hora_inicio'])) . ' - ' . date("H:i", strtotime($quedada['hora_fin'])); ?></div>
                                <div class="flex items-center gap-3"><i class="fa-solid fa-location-dot text-[#D2691E]"></i><?php echo htmlspecialchars($quedada['ubicacion'] . ', ' . $quedada['provincia']); ?></div>
                            </div>
                            <p class="text-gray-600 text-sm mb-6 line-clamp-2"><?php echo htmlspecialchars($quedada['descripcion']); ?></p>
                            <div class="mb-6">
                                <div class="flex justify-between text-xs mb-2"><span class="text-gray-400 font-medium">Plazas ocupadas</span><span class="text-gray-400"><?php echo $porcentaje; ?>%</span></div>
                                <div class="w-full bg-gray-100 rounded-full h-2"><div class="bg-[#D2691E] h-full rounded-full" style="width: <?php echo $porcentaje; ?>%"></div></div>
                            </div>
                            <?php if (isset($_SESSION['usuario'])): ?>
                                <form action="../Controlador/controlador_inscripcion.php" method="POST">
                                    <input type="hidden" name="id_quedada" value="<?php echo $quedada['id']; ?>">
                                    <button type="submit" class="w-full py-4 bg-[#D2691E] hover:bg-[#b85c1a] text-white text-center rounded-xl font-bold transition-colors">Apuntarme</button>
                                </form>
                            <?php else: ?>
                                <a href="login.php" class="block w-full py-4 border-2 border-[#1a4d2e] text-[#1a4d2e] hover:bg-[#1a4d2e] hover:text-white text-center rounded-xl font-bold transition-all">Inicia sesión para apuntarte</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Tarjeta 4: Montes de Toledo -->
                <?php if ($resultadoQuedadas && $quedada = mysqli_fetch_assoc($resultadoQuedadas)): 
                    $porcentaje = ($quedada['plazas_totales'] > 0) ? round(($quedada['plazas_ocupadas'] / $quedada['plazas_totales']) * 100) : 0; ?>
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                        <div class="relative h-64 overflow-hidden">
                            <img src="../assets/imagenes/toledo.jpg" alt="Montes de Toledo" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-gray-700 flex items-center gap-1">
                                <i class="fa-solid fa-users text-[#D2691E]"></i>
                                <?php echo $quedada['plazas_ocupadas'] . '/' . $quedada['plazas_totales']; ?>
                            </div>
                        </div>
                        <div class="p-8">
                            <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-4"><?php echo htmlspecialchars($quedada['titulo']); ?></h3>
                            <div class="space-y-3 mb-6 text-sm text-gray-500">
                                <div class="flex items-center gap-3"><i class="fa-regular fa-calendar text-[#D2691E]"></i><?php echo date("d M Y", strtotime($quedada['fecha'])); ?></div>
                                <div class="flex items-center gap-3"><i class="fa-regular fa-clock text-[#D2691E]"></i><?php echo date("H:i", strtotime($quedada['hora_inicio'])) . ' - ' . date("H:i", strtotime($quedada['hora_fin'])); ?></div>
                                <div class="flex items-center gap-3"><i class="fa-solid fa-location-dot text-[#D2691E]"></i><?php echo htmlspecialchars($quedada['ubicacion'] . ', ' . $quedada['provincia']); ?></div>
                            </div>
                            <p class="text-gray-600 text-sm mb-6 line-clamp-2"><?php echo htmlspecialchars($quedada['descripcion']); ?></p>
                            <div class="mb-6">
                                <div class="flex justify-between text-xs mb-2"><span class="text-gray-400 font-medium">Plazas ocupadas</span><span class="text-gray-400"><?php echo $porcentaje; ?>%</span></div>
                                <div class="w-full bg-gray-100 rounded-full h-2"><div class="bg-[#D2691E] h-full rounded-full" style="width: <?php echo $porcentaje; ?>%"></div></div>
                            </div>
                            <?php if (isset($_SESSION['usuario'])): ?>
                                <form action="../Controlador/controlador_inscripcion.php" method="POST">
                                    <input type="hidden" name="id_quedada" value="<?php echo $quedada['id']; ?>">
                                    <button type="submit" class="w-full py-4 bg-[#D2691E] hover:bg-[#b85c1a] text-white text-center rounded-xl font-bold transition-colors">Apuntarme</button>
                                </form>
                            <?php else: ?>
                                <a href="login.php" class="block w-full py-4 border-2 border-[#1a4d2e] text-[#1a4d2e] hover:bg-[#1a4d2e] hover:text-white text-center rounded-xl font-bold transition-all">Inicia sesión para apuntarte</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Tarjeta 5: Extremadura -->
                <?php if ($resultadoQuedadas && $quedada = mysqli_fetch_assoc($resultadoQuedadas)): 
                    $porcentaje = ($quedada['plazas_totales'] > 0) ? round(($quedada['plazas_ocupadas'] / $quedada['plazas_totales']) * 100) : 0; ?>
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                        <div class="relative h-64 overflow-hidden">
                            <img src="../assets/imagenes/extremadura.jpg" alt="Extremadura" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-gray-700 flex items-center gap-1">
                                <i class="fa-solid fa-users text-[#D2691E]"></i>
                                <?php echo $quedada['plazas_ocupadas'] . '/' . $quedada['plazas_totales']; ?>
                            </div>
                        </div>
                        <div class="p-8">
                            <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-4"><?php echo htmlspecialchars($quedada['titulo']); ?></h3>
                            <div class="space-y-3 mb-6 text-sm text-gray-500">
                                <div class="flex items-center gap-3"><i class="fa-regular fa-calendar text-[#D2691E]"></i><?php echo date("d M Y", strtotime($quedada['fecha'])); ?></div>
                                <div class="flex items-center gap-3"><i class="fa-regular fa-clock text-[#D2691E]"></i><?php echo date("H:i", strtotime($quedada['hora_inicio'])) . ' - ' . date("H:i", strtotime($quedada['hora_fin'])); ?></div>
                                <div class="flex items-center gap-3"><i class="fa-solid fa-location-dot text-[#D2691E]"></i><?php echo htmlspecialchars($quedada['ubicacion'] . ', ' . $quedada['provincia']); ?></div>
                            </div>
                            <p class="text-gray-600 text-sm mb-6 line-clamp-2"><?php echo htmlspecialchars($quedada['descripcion']); ?></p>
                            <div class="mb-6">
                                <div class="flex justify-between text-xs mb-2"><span class="text-gray-400 font-medium">Plazas ocupadas</span><span class="text-gray-400"><?php echo $porcentaje; ?>%</span></div>
                                <div class="w-full bg-gray-100 rounded-full h-2"><div class="bg-[#D2691E] h-full rounded-full" style="width: <?php echo $porcentaje; ?>%"></div></div>
                            </div>
                            <?php if (isset($_SESSION['usuario'])): ?>
                                <form action="../Controlador/controlador_inscripcion.php" method="POST">
                                    <input type="hidden" name="id_quedada" value="<?php echo $quedada['id']; ?>">
                                    <button type="submit" class="w-full py-4 bg-[#D2691E] hover:bg-[#b85c1a] text-white text-center rounded-xl font-bold transition-colors">Apuntarme</button>
                                </form>
                            <?php else: ?>
                                <a href="login.php" class="block w-full py-4 border-2 border-[#1a4d2e] text-[#1a4d2e] hover:bg-[#1a4d2e] hover:text-white text-center rounded-xl font-bold transition-all">Inicia sesión para apuntarte</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Tarjeta 6: Portugal -->
                <?php if ($resultadoQuedadas && $quedada = mysqli_fetch_assoc($resultadoQuedadas)): 
                    $porcentaje = ($quedada['plazas_totales'] > 0) ? round(($quedada['plazas_ocupadas'] / $quedada['plazas_totales']) * 100) : 0; ?>
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                        <div class="relative h-64 overflow-hidden">
                            <img src="../assets/imagenes/portugal.jpg" alt="Portugal" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-gray-700 flex items-center gap-1">
                                <i class="fa-solid fa-users text-[#D2691E]"></i>
                                <?php echo $quedada['plazas_ocupadas'] . '/' . $quedada['plazas_totales']; ?>
                            </div>
                        </div>
                        <div class="p-8">
                            <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-4"><?php echo htmlspecialchars($quedada['titulo']); ?></h3>
                            <div class="space-y-3 mb-6 text-sm text-gray-500">
                                <div class="flex items-center gap-3"><i class="fa-regular fa-calendar text-[#D2691E]"></i><?php echo date("d M Y", strtotime($quedada['fecha'])); ?></div>
                                <div class="flex items-center gap-3"><i class="fa-regular fa-clock text-[#D2691E]"></i><?php echo date("H:i", strtotime($quedada['hora_inicio'])) . ' - ' . date("H:i", strtotime($quedada['hora_fin'])); ?></div>
                                <div class="flex items-center gap-3"><i class="fa-solid fa-location-dot text-[#D2691E]"></i><?php echo htmlspecialchars($quedada['ubicacion'] . ', ' . $quedada['provincia']); ?></div>
                            </div>
                            <p class="text-gray-600 text-sm mb-6 line-clamp-2"><?php echo htmlspecialchars($quedada['descripcion']); ?></p>
                            <div class="mb-6">
                                <div class="flex justify-between text-xs mb-2"><span class="text-gray-400 font-medium">Plazas ocupadas</span><span class="text-gray-400"><?php echo $porcentaje; ?>%</span></div>
                                <div class="w-full bg-gray-100 rounded-full h-2"><div class="bg-[#D2691E] h-full rounded-full" style="width: <?php echo $porcentaje; ?>%"></div></div>
                            </div>
                            <?php if (isset($_SESSION['usuario'])): ?>
                                <form action="../Controlador/controlador_inscripcion.php" method="POST">
                                    <input type="hidden" name="id_quedada" value="<?php echo $quedada['id']; ?>">
                                    <button type="submit" class="w-full py-4 bg-[#D2691E] hover:bg-[#b85c1a] text-white text-center rounded-xl font-bold transition-colors">Apuntarme</button>
                                </form>
                            <?php else: ?>
                                <a href="login.php" class="block w-full py-4 border-2 border-[#1a4d2e] text-[#1a4d2e] hover:bg-[#1a4d2e] hover:text-white text-center rounded-xl font-bold transition-all">Inicia sesión para apuntarte</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>
    <!-- FIN DE QUEDADAS  -->

</main>

<?php include '../Partes/footer.php'; ?>