<?php 
// vista del listado de quedadas, espera que el controlador le pase $resultadoQuedadas
if (!isset($resultadoQuedadas)) {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    $_SESSION['activeTab'] = 'quedadas';
    header('Location: ../Controlador/controlador_quedadas.php');
    exit();
}

include '../Partes/header.php'; 
?>

<main class="flex-grow bg-[#f8f7f4]">

    <!-- sección hero: título y descripción de la página -->
    <section class="bg-[#1a4d2e] pt-32 pb-20 px-4 text-center text-white">
        <div class="max-w-4xl mx-auto">
            <span class="bg-[#D2691E] text-white text-xs font-bold px-4 py-1.5 rounded-full uppercase mb-6 inline-block">Participa</span>
            <h1 class="text-5xl md:text-7xl font-serif font-bold mb-6">
                Quedadas de <span class="text-[#D2691E]">Limpieza</span>
            </h1>
            <p class="text-gray-200 text-lg md:text-xl max-w-3xl mx-auto mb-16">
                Únete a nuestros voluntarios y ayuda a mantener limpio el hábitat del lince ibérico. ¡Cada mano cuenta!
            </p>
        </div>
    </section>

    <!-- mensaje de éxito si el controlador lo ha guardado en sesión -->
    <?php if (isset($_SESSION['mensaje_exito'])): ?>
        <div class="max-w-7xl mx-auto mt-8 px-4">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-xl shadow-sm font-sans flex items-center gap-2">
                <i class="fa-solid fa-circle-check"></i>
                <span><?php echo $_SESSION['mensaje_exito']; ?></span>
            </div>
        </div>
        <?php unset($_SESSION['mensaje_exito']); ?>
    <?php endif; ?>

    <!-- mensaje de error si el controlador lo ha guardado en sesión -->
    <?php if (isset($_SESSION['mensaje_error'])): ?>
        <div class="max-w-7xl mx-auto mt-8 px-4">
            <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 rounded-xl shadow-sm font-sans flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span><?php echo $_SESSION['mensaje_error']; ?></span>
            </div>
        </div>
        <?php unset($_SESSION['mensaje_error']); ?>
    <?php endif; ?>

    <!-- sección del listado de tarjetas de quedadas -->
    <section class="py-16 px-4">
        <div class="max-w-7xl mx-auto">

            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-[#1a4d2e] mb-4">Próximos Eventos</h2>
                <p class="text-gray-500">Elige la quedada que mejor te venga y reserva tu plaza. ¡Las plazas son limitadas!</p>
            </div>

            <!-- grid de tarjetas: cada bloque muestra una quedada de la bd -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                <!-- tarjeta 1: Sierra de Andújar -->
                <?php if ($resultadoQuedadas && $quedada = mysqli_fetch_assoc($resultadoQuedadas)): 
                    // calculamos el porcentaje de ocupación para la barra de progreso
                    $porcentaje = ($quedada['plazas_totales'] > 0) ? round(($quedada['plazas_ocupadas'] / $quedada['plazas_totales']) * 100) : 0; ?>
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group flex flex-col">
                        <!-- imagen de cabecera de la tarjeta -->
                        <div class="relative h-64 overflow-hidden">
                            <img src="../assets/imagenes/Andujar.jpg" alt="Andújar" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <!-- badge con plazas ocupadas sobre la imagen -->
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-gray-700 flex items-center gap-1">
                                <i class="fa-solid fa-users text-[#D2691E]"></i>
                                <?php echo $quedada['plazas_ocupadas'] . '/' . $quedada['plazas_totales']; ?>
                            </div>
                        </div>
                        <div class="p-8 flex flex-col flex-grow">
                            <!-- título de la quedada -->
                            <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-4"><?php echo htmlspecialchars($quedada['titulo']); ?></h3>
                            <!-- datos de fecha, hora y ubicación -->
                            <div class="space-y-3 mb-6 text-sm text-gray-500">
                                <div class="flex items-center gap-3"><i class="fa-regular fa-calendar text-[#D2691E]"></i><?php echo date("d M Y", strtotime($quedada['fecha'])); ?></div>
                                <div class="flex items-center gap-3"><i class="fa-regular fa-clock text-[#D2691E]"></i><?php echo date("H:i", strtotime($quedada['hora_inicio'])) . ' - ' . date("H:i", strtotime($quedada['hora_fin'])); ?></div>
                                <div class="flex items-center gap-3"><i class="fa-solid fa-location-dot text-[#D2691E]"></i><?php echo htmlspecialchars($quedada['ubicacion'] . ', ' . $quedada['provincia']); ?></div>
                            </div>
                            <!-- descripción recortada a 2 líneas -->
                            <p class="text-gray-600 text-sm mb-6 line-clamp-2 flex-grow"><?php echo htmlspecialchars($quedada['descripcion']); ?></p>
                            <!-- barra de progreso de ocupación -->
                            <div class="mb-6">
                                <div class="flex justify-between text-xs mb-2"><span class="text-gray-400 font-medium">Plazas ocupadas</span><span class="text-gray-400"><?php echo $porcentaje; ?>%</span></div>
                                <div class="w-full bg-gray-100 rounded-full h-2"><div class="bg-[#D2691E] h-full rounded-full" style="width: <?php echo $porcentaje; ?>%"></div></div>
                            </div>
                            <?php if (isset($_SESSION['id'])):
                                $usuario_id_session = $_SESSION['id'];
                                // comprobamos si el usuario ya está inscrito en esta quedada
                                $inscrito = esta_inscrito($conexion, $usuario_id_session, $quedada['id']);
                            ?>
                                <?php if ($inscrito): ?>
                                    <!-- si ya está inscrito mostramos el botón de salir -->
                                    <form action="../Controlador/controlador_inscripcion.php" method="POST">
                                        <input type="hidden" name="id_quedada" value="<?php echo $quedada['id']; ?>">
                                        <input type="hidden" name="accion" value="quitar">
                                        <button type="submit" class="w-full py-4 bg-red-600 hover:bg-red-700 text-white text-center rounded-xl font-bold transition-colors">Salir de la quedada</button>
                                    </form>
                                <?php else: ?>
                                    <!-- si no está inscrito mostramos el botón de apuntarse -->
                                    <form action="../Controlador/controlador_inscripcion.php" method="POST">
                                        <input type="hidden" name="id_quedada" value="<?php echo $quedada['id']; ?>">
                                        <input type="hidden" name="accion" value="apuntar">
                                        <button type="submit" class="w-full py-4 bg-[#D2691E] hover:bg-[#b85c1a] text-white text-center rounded-xl font-bold transition-colors">Apuntarme</button>
                                    </form>
                                <?php endif; ?>
                            <?php else: ?>
                                <!-- si no hay sesión pedimos al usuario que inicie sesión -->
                                <a href="../vista/login.php" class="block w-full py-4 border-2 border-[#1a4d2e] text-[#1a4d2e] hover:bg-[#1a4d2e] hover:text-white text-center rounded-xl font-bold transition-all">Inicia sesión para apuntarte</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- tarjeta 2: Doñana -->
                <?php if ($resultadoQuedadas && $quedada = mysqli_fetch_assoc($resultadoQuedadas)): 
                    $porcentaje = ($quedada['plazas_totales'] > 0) ? round(($quedada['plazas_ocupadas'] / $quedada['plazas_totales']) * 100) : 0; ?>
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group flex flex-col">
                        <div class="relative h-64 overflow-hidden">
                            <img src="../assets/imagenes/Doñana.jpg" alt="Doñana" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-gray-700 flex items-center gap-1">
                                <i class="fa-solid fa-users text-[#D2691E]"></i>
                                <?php echo $quedada['plazas_ocupadas'] . '/' . $quedada['plazas_totales']; ?>
                            </div>
                        </div>
                        <div class="p-8 flex flex-col flex-grow">
                            <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-4"><?php echo htmlspecialchars($quedada['titulo']); ?></h3>
                            <div class="space-y-3 mb-6 text-sm text-gray-500">
                                <div class="flex items-center gap-3"><i class="fa-regular fa-calendar text-[#D2691E]"></i><?php echo date("d M Y", strtotime($quedada['fecha'])); ?></div>
                                <div class="flex items-center gap-3"><i class="fa-regular fa-clock text-[#D2691E]"></i><?php echo date("H:i", strtotime($quedada['hora_inicio'])) . ' - ' . date("H:i", strtotime($quedada['hora_fin'])); ?></div>
                                <div class="flex items-center gap-3"><i class="fa-solid fa-location-dot text-[#D2691E]"></i><?php echo htmlspecialchars($quedada['ubicacion'] . ', ' . $quedada['provincia']); ?></div>
                            </div>
                            <p class="text-gray-600 text-sm mb-6 line-clamp-2 flex-grow"><?php echo htmlspecialchars($quedada['descripcion']); ?></p>
                            <div class="mb-6">
                                <div class="flex justify-between text-xs mb-2"><span class="text-gray-400 font-medium">Plazas ocupadas</span><span class="text-gray-400"><?php echo $porcentaje; ?>%</span></div>
                                <div class="w-full bg-gray-100 rounded-full h-2"><div class="bg-[#D2691E] h-full rounded-full" style="width: <?php echo $porcentaje; ?>%"></div></div>
                            </div>
                            <?php if (isset($_SESSION['id'])):
                                $usuario_id_session = $_SESSION['id'];
                                $inscrito = esta_inscrito($conexion, $usuario_id_session, $quedada['id']);
                            ?>
                                <?php if ($inscrito): ?>
                                    <form action="../Controlador/controlador_inscripcion.php" method="POST">
                                        <input type="hidden" name="id_quedada" value="<?php echo $quedada['id']; ?>">
                                        <input type="hidden" name="accion" value="quitar">
                                        <button type="submit" class="w-full py-4 bg-red-600 hover:bg-red-700 text-white text-center rounded-xl font-bold transition-colors">Salir de la quedada</button>
                                    </form>
                                <?php else: ?>
                                    <form action="../Controlador/controlador_inscripcion.php" method="POST">
                                        <input type="hidden" name="id_quedada" value="<?php echo $quedada['id']; ?>">
                                        <input type="hidden" name="accion" value="apuntar">
                                        <button type="submit" class="w-full py-4 bg-[#D2691E] hover:bg-[#b85c1a] text-white text-center rounded-xl font-bold transition-colors">Apuntarme</button>
                                    </form>
                                <?php endif; ?>
                            <?php else: ?>
                                <a href="../vista/login.php" class="block w-full py-4 border-2 border-[#1a4d2e] text-[#1a4d2e] hover:bg-[#1a4d2e] hover:text-white text-center rounded-xl font-bold transition-all">Inicia sesión para apuntarte</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- tarjeta 3: Sierra Morena -->
                <?php if ($resultadoQuedadas && $quedada = mysqli_fetch_assoc($resultadoQuedadas)): 
                    $porcentaje = ($quedada['plazas_totales'] > 0) ? round(($quedada['plazas_ocupadas'] / $quedada['plazas_totales']) * 100) : 0; ?>
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group flex flex-col">
                        <div class="relative h-64 overflow-hidden">
                            <img src="../assets/imagenes/Sierra_morena.jpg" alt="Sierra Morena" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-gray-700 flex items-center gap-1">
                                <i class="fa-solid fa-users text-[#D2691E]"></i>
                                <?php echo $quedada['plazas_ocupadas'] . '/' . $quedada['plazas_totales']; ?>
                            </div>
                        </div>
                        <div class="p-8 flex flex-col flex-grow">
                            <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-4"><?php echo htmlspecialchars($quedada['titulo']); ?></h3>
                            <div class="space-y-3 mb-6 text-sm text-gray-500">
                                <div class="flex items-center gap-3"><i class="fa-regular fa-calendar text-[#D2691E]"></i><?php echo date("d M Y", strtotime($quedada['fecha'])); ?></div>
                                <div class="flex items-center gap-3"><i class="fa-regular fa-clock text-[#D2691E]"></i><?php echo date("H:i", strtotime($quedada['hora_inicio'])) . ' - ' . date("H:i", strtotime($quedada['hora_fin'])); ?></div>
                                <div class="flex items-center gap-3"><i class="fa-solid fa-location-dot text-[#D2691E]"></i><?php echo htmlspecialchars($quedada['ubicacion'] . ', ' . $quedada['provincia']); ?></div>
                            </div>
                            <p class="text-gray-600 text-sm mb-6 line-clamp-2 flex-grow"><?php echo htmlspecialchars($quedada['descripcion']); ?></p>
                            <div class="mb-6">
                                <div class="flex justify-between text-xs mb-2"><span class="text-gray-400 font-medium">Plazas ocupadas</span><span class="text-gray-400"><?php echo $porcentaje; ?>%</span></div>
                                <div class="w-full bg-gray-100 rounded-full h-2"><div class="bg-[#D2691E] h-full rounded-full" style="width: <?php echo $porcentaje; ?>%"></div></div>
                            </div>
                            <?php if (isset($_SESSION['id'])):
                                $usuario_id_session = $_SESSION['id'];
                                $inscrito = esta_inscrito($conexion, $usuario_id_session, $quedada['id']);
                            ?>
                                <?php if ($inscrito): ?>
                                    <form action="../Controlador/controlador_inscripcion.php" method="POST">
                                        <input type="hidden" name="id_quedada" value="<?php echo $quedada['id']; ?>">
                                        <input type="hidden" name="accion" value="quitar">
                                        <button type="submit" class="w-full py-4 bg-red-600 hover:bg-red-700 text-white text-center rounded-xl font-bold transition-colors">Salir de la quedada</button>
                                    </form>
                                <?php else: ?>
                                    <form action="../Controlador/controlador_inscripcion.php" method="POST">
                                        <input type="hidden" name="id_quedada" value="<?php echo $quedada['id']; ?>">
                                        <input type="hidden" name="accion" value="apuntar">
                                        <button type="submit" class="w-full py-4 bg-[#D2691E] hover:bg-[#b85c1a] text-white text-center rounded-xl font-bold transition-colors">Apuntarme</button>
                                    </form>
                                <?php endif; ?>
                            <?php else: ?>
                                <a href="../vista/login.php" class="block w-full py-4 border-2 border-[#1a4d2e] text-[#1a4d2e] hover:bg-[#1a4d2e] hover:text-white text-center rounded-xl font-bold transition-all">Inicia sesión para apuntarte</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- tarjeta 4: Montes de Toledo -->
                <?php if ($resultadoQuedadas && $quedada = mysqli_fetch_assoc($resultadoQuedadas)): 
                    $porcentaje = ($quedada['plazas_totales'] > 0) ? round(($quedada['plazas_ocupadas'] / $quedada['plazas_totales']) * 100) : 0; ?>
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group flex flex-col">
                        <div class="relative h-64 overflow-hidden">
                            <img src="../assets/imagenes/toledo.jpg" alt="Montes de Toledo" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-gray-700 flex items-center gap-1">
                                <i class="fa-solid fa-users text-[#D2691E]"></i>
                                <?php echo $quedada['plazas_ocupadas'] . '/' . $quedada['plazas_totales']; ?>
                            </div>
                        </div>
                        <div class="p-8 flex flex-col flex-grow">
                            <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-4"><?php echo htmlspecialchars($quedada['titulo']); ?></h3>
                            <div class="space-y-3 mb-6 text-sm text-gray-500">
                                <div class="flex items-center gap-3"><i class="fa-regular fa-calendar text-[#D2691E]"></i><?php echo date("d M Y", strtotime($quedada['fecha'])); ?></div>
                                <div class="flex items-center gap-3"><i class="fa-regular fa-clock text-[#D2691E]"></i><?php echo date("H:i", strtotime($quedada['hora_inicio'])) . ' - ' . date("H:i", strtotime($quedada['hora_fin'])); ?></div>
                                <div class="flex items-center gap-3"><i class="fa-solid fa-location-dot text-[#D2691E]"></i><?php echo htmlspecialchars($quedada['ubicacion'] . ', ' . $quedada['provincia']); ?></div>
                            </div>
                            <p class="text-gray-600 text-sm mb-6 line-clamp-2 flex-grow"><?php echo htmlspecialchars($quedada['descripcion']); ?></p>
                            <div class="mb-6">
                                <div class="flex justify-between text-xs mb-2"><span class="text-gray-400 font-medium">Plazas ocupadas</span><span class="text-gray-400"><?php echo $porcentaje; ?>%</span></div>
                                <div class="w-full bg-gray-100 rounded-full h-2"><div class="bg-[#D2691E] h-full rounded-full" style="width: <?php echo $porcentaje; ?>%"></div></div>
                            </div>
                            <?php if (isset($_SESSION['id'])):
                                $usuario_id_session = $_SESSION['id'];
                                $inscrito = esta_inscrito($conexion, $usuario_id_session, $quedada['id']);
                            ?>
                                <?php if ($inscrito): ?>
                                    <form action="../Controlador/controlador_inscripcion.php" method="POST">
                                        <input type="hidden" name="id_quedada" value="<?php echo $quedada['id']; ?>">
                                        <input type="hidden" name="accion" value="quitar">
                                        <button type="submit" class="w-full py-4 bg-red-600 hover:bg-red-700 text-white text-center rounded-xl font-bold transition-colors">Salir de la quedada</button>
                                    </form>
                                <?php else: ?>
                                    <form action="../Controlador/controlador_inscripcion.php" method="POST">
                                        <input type="hidden" name="id_quedada" value="<?php echo $quedada['id']; ?>">
                                        <input type="hidden" name="accion" value="apuntar">
                                        <button type="submit" class="w-full py-4 bg-[#D2691E] hover:bg-[#b85c1a] text-white text-center rounded-xl font-bold transition-colors">Apuntarme</button>
                                    </form>
                                <?php endif; ?>
                            <?php else: ?>
                                <a href="../vista/login.php" class="block w-full py-4 border-2 border-[#1a4d2e] text-[#1a4d2e] hover:bg-[#1a4d2e] hover:text-white text-center rounded-xl font-bold transition-all">Inicia sesión para apuntarte</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- tarjeta 5: Extremadura -->
                <?php if ($resultadoQuedadas && $quedada = mysqli_fetch_assoc($resultadoQuedadas)): 
                    $porcentaje = ($quedada['plazas_totales'] > 0) ? round(($quedada['plazas_ocupadas'] / $quedada['plazas_totales']) * 100) : 0; ?>
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group flex flex-col">
                        <div class="relative h-64 overflow-hidden">
                            <img src="../assets/imagenes/extremadura.jpg" alt="Extremadura" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-gray-700 flex items-center gap-1">
                                <i class="fa-solid fa-users text-[#D2691E]"></i>
                                <?php echo $quedada['plazas_ocupadas'] . '/' . $quedada['plazas_totales']; ?>
                            </div>
                        </div>
                        <div class="p-8 flex flex-col flex-grow">
                            <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-4"><?php echo htmlspecialchars($quedada['titulo']); ?></h3>
                            <div class="space-y-3 mb-6 text-sm text-gray-500">
                                <div class="flex items-center gap-3"><i class="fa-regular fa-calendar text-[#D2691E]"></i><?php echo date("d M Y", strtotime($quedada['fecha'])); ?></div>
                                <div class="flex items-center gap-3"><i class="fa-regular fa-clock text-[#D2691E]"></i><?php echo date("H:i", strtotime($quedada['hora_inicio'])) . ' - ' . date("H:i", strtotime($quedada['hora_fin'])); ?></div>
                                <div class="flex items-center gap-3"><i class="fa-solid fa-location-dot text-[#D2691E]"></i><?php echo htmlspecialchars($quedada['ubicacion'] . ', ' . $quedada['provincia']); ?></div>
                            </div>
                            <p class="text-gray-600 text-sm mb-6 line-clamp-2 flex-grow"><?php echo htmlspecialchars($quedada['descripcion']); ?></p>
                            <div class="mb-6">
                                <div class="flex justify-between text-xs mb-2"><span class="text-gray-400 font-medium">Plazas ocupadas</span><span class="text-gray-400"><?php echo $porcentaje; ?>%</span></div>
                                <div class="w-full bg-gray-100 rounded-full h-2"><div class="bg-[#D2691E] h-full rounded-full" style="width: <?php echo $porcentaje; ?>%"></div></div>
                            </div>
                            <?php if (isset($_SESSION['id'])):
                                $usuario_id_session = $_SESSION['id'];
                                $inscrito = esta_inscrito($conexion, $usuario_id_session, $quedada['id']);
                            ?>
                                <?php if ($inscrito): ?>
                                    <form action="../Controlador/controlador_inscripcion.php" method="POST">
                                        <input type="hidden" name="id_quedada" value="<?php echo $quedada['id']; ?>">
                                        <input type="hidden" name="accion" value="quitar">
                                        <button type="submit" class="w-full py-4 bg-red-600 hover:bg-red-700 text-white text-center rounded-xl font-bold transition-colors">Salir de la quedada</button>
                                    </form>
                                <?php else: ?>
                                    <form action="../Controlador/controlador_inscripcion.php" method="POST">
                                        <input type="hidden" name="id_quedada" value="<?php echo $quedada['id']; ?>">
                                        <input type="hidden" name="accion" value="apuntar">
                                        <button type="submit" class="w-full py-4 bg-[#D2691E] hover:bg-[#b85c1a] text-white text-center rounded-xl font-bold transition-colors">Apuntarme</button>
                                    </form>
                                <?php endif; ?>
                            <?php else: ?>
                                <a href="../vista/login.php" class="block w-full py-4 border-2 border-[#1a4d2e] text-[#1a4d2e] hover:bg-[#1a4d2e] hover:text-white text-center rounded-xl font-bold transition-all">Inicia sesión para apuntarte</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- tarjeta 6: Portugal -->
                <?php if ($resultadoQuedadas && $quedada = mysqli_fetch_assoc($resultadoQuedadas)): 
                    $porcentaje = ($quedada['plazas_totales'] > 0) ? round(($quedada['plazas_ocupadas'] / $quedada['plazas_totales']) * 100) : 0; ?>
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group flex flex-col">
                        <div class="relative h-64 overflow-hidden">
                            <img src="../assets/imagenes/portugal.jpg" alt="Portugal" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-gray-700 flex items-center gap-1">
                                <i class="fa-solid fa-users text-[#D2691E]"></i>
                                <?php echo $quedada['plazas_ocupadas'] . '/' . $quedada['plazas_totales']; ?>
                            </div>
                        </div>
                        <div class="p-8 flex flex-col flex-grow">
                            <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-4"><?php echo htmlspecialchars($quedada['titulo']); ?></h3>
                            <div class="space-y-3 mb-6 text-sm text-gray-500">
                                <div class="flex items-center gap-3"><i class="fa-regular fa-calendar text-[#D2691E]"></i><?php echo date("d M Y", strtotime($quedada['fecha'])); ?></div>
                                <div class="flex items-center gap-3"><i class="fa-regular fa-clock text-[#D2691E]"></i><?php echo date("H:i", strtotime($quedada['hora_inicio'])) . ' - ' . date("H:i", strtotime($quedada['hora_fin'])); ?></div>
                                <div class="flex items-center gap-3"><i class="fa-solid fa-location-dot text-[#D2691E]"></i><?php echo htmlspecialchars($quedada['ubicacion'] . ', ' . $quedada['provincia']); ?></div>
                            </div>
                            <p class="text-gray-600 text-sm mb-6 line-clamp-2 flex-grow"><?php echo htmlspecialchars($quedada['descripcion']); ?></p>
                            <div class="mb-6">
                                <div class="flex justify-between text-xs mb-2"><span class="text-gray-400 font-medium">Plazas ocupadas</span><span class="text-gray-400"><?php echo $porcentaje; ?>%</span></div>
                                <div class="w-full bg-gray-100 rounded-full h-2"><div class="bg-[#D2691E] h-full rounded-full" style="width: <?php echo $porcentaje; ?>%"></div></div>
                            </div>
                            <?php if (isset($_SESSION['id'])):
                                $usuario_id_session = $_SESSION['id'];
                                $inscrito = esta_inscrito($conexion, $usuario_id_session, $quedada['id']);
                            ?>
                                <?php if ($inscrito): ?>
                                    <form action="../Controlador/controlador_inscripcion.php" method="POST">
                                        <input type="hidden" name="id_quedada" value="<?php echo $quedada['id']; ?>">
                                        <input type="hidden" name="accion" value="quitar">
                                        <button type="submit" class="w-full py-4 bg-red-600 hover:bg-red-700 text-white text-center rounded-xl font-bold transition-colors">Salir de la quedada</button>
                                    </form>
                                <?php else: ?>
                                    <form action="../Controlador/controlador_inscripcion.php" method="POST">
                                        <input type="hidden" name="id_quedada" value="<?php echo $quedada['id']; ?>">
                                        <input type="hidden" name="accion" value="apuntar">
                                        <button type="submit" class="w-full py-4 bg-[#D2691E] hover:bg-[#b85c1a] text-white text-center rounded-xl font-bold transition-colors">Apuntarme</button>
                                    </form>
                                <?php endif; ?>
                            <?php else: ?>
                                <a href="../vista/login.php" class="block w-full py-4 border-2 border-[#1a4d2e] text-[#1a4d2e] hover:bg-[#1a4d2e] hover:text-white text-center rounded-xl font-bold transition-all">Inicia sesión para apuntarte</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>
</main>

<?php include '../Partes/footer.php'; ?>