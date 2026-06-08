<?php
// vista del formulario de edición de quedada, espera que el controlador le pase la variable $quedada
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// si no hay sesión activa o no es admin redirigimos al login
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// si no llega la variable $quedada desde el controlador volvemos al panel
if (!isset($quedada) || !$quedada) {
    $_SESSION['activeTab'] = 'quedadas';
    header('Location: ../Controlador/controlador_admin.php');
    exit;
}

include '../Partes/header.php';
?>

<main class="flex-grow bg-[#f8f7f4] py-20">
    <div class="max-w-4xl mx-auto px-4">

        <!-- encabezado con botón de volver al panel y título de la página -->
        <div class="mb-8">
            <!-- formulario que simula un enlace de vuelta al panel en la pestaña de quedadas -->
            <form method="POST" action="../Controlador/controlador_admin.php" class="text-sm text-gray-400 hover:text-[#1a4d2e] transition-colors flex items-center gap-2 group bg-transparent border-0 p-0">
                <input type="hidden" name="tab" value="quedadas">
                <button type="submit" class="flex items-center gap-2 text-sm text-gray-400 hover:text-[#1a4d2e] transition-colors">
                    <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                    Volver al panel
                </button>
            </form>
            <h2 class="text-3xl font-serif font-bold text-[#1a4d2e] mt-4">Editar Quedada</h2>
            <p class="text-gray-500 text-sm">Modifica los datos del evento para actualizarlo en el panel.</p>
        </div>

        <!-- bloque de errores de validación, solo se muestra si el controlador los devuelve -->
        <?php if (!empty($errores)): ?>
            <div class="mb-8 bg-red-50 border border-red-200 rounded-xl p-4">
                <div class="text-red-700 font-semibold mb-2">Errores en el formulario:</div>
                <ul class="list-disc list-inside text-red-600 text-sm">
                    <?php foreach ($errores as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- tarjeta blanca con el formulario de edición -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
            <form action="../Controlador/controlador_editar_quedada.php" method="POST" class="space-y-6">

                <!-- campo oculto con el id de la quedada para que el controlador sepa cuál actualizar -->
                <input type="hidden" name="id_quedada" value="<?php echo intval($quedada['id']); ?>">

                <!-- campo título -->
                <div>
                    <label class="block text-sm font-bold text-[#1a4d2e] uppercase mb-2">Título del evento</label>
                    <input type="text" name="titulo" required value="<?php echo htmlspecialchars($quedada['titulo'] ?? ''); ?>"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#1a4d2e] outline-none transition"
                           placeholder="Ej: Limpieza de Sierra Morena">
                </div>

                <!-- campo descripción -->
                <div>
                    <label class="block text-sm font-bold text-[#1a4d2e] uppercase mb-2">Descripción</label>
                    <textarea name="descripcion" rows="4"
                              class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#1a4d2e] outline-none transition"
                              placeholder="Describe el evento, actividades, recomendaciones..."><?php echo htmlspecialchars($quedada['descripcion'] ?? ''); ?></textarea>
                </div>

                <!-- campos de fecha, hora de inicio y hora de fin en una fila de 3 columnas -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-[#1a4d2e] uppercase mb-2">Fecha</label>
                        <input type="date" name="fecha" required value="<?php echo htmlspecialchars($quedada['fecha'] ?? ''); ?>"
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#1a4d2e] outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#1a4d2e] uppercase mb-2">Hora inicio</label>
                        <input type="time" name="hora_inicio" required value="<?php echo htmlspecialchars($quedada['hora_inicio'] ?? ''); ?>"
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#1a4d2e] outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#1a4d2e] uppercase mb-2">Hora fin</label>
                        <input type="time" name="hora_fin" required value="<?php echo htmlspecialchars($quedada['hora_fin'] ?? ''); ?>"
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#1a4d2e] outline-none transition">
                    </div>
                </div>

                <!-- campos de ubicación y provincia en dos columnas -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-[#1a4d2e] uppercase mb-2">Ubicación</label>
                        <input type="text" name="ubicacion" required value="<?php echo htmlspecialchars($quedada['ubicacion'] ?? ''); ?>"
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#1a4d2e] outline-none transition"
                               placeholder="Ej: Parque Natural...">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#1a4d2e] uppercase mb-2">Provincia</label>
                        <input type="text" name="provincia" required value="<?php echo htmlspecialchars($quedada['provincia'] ?? ''); ?>"
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#1a4d2e] outline-none transition"
                               placeholder="Ej: Jaén">
                    </div>
                </div>

                <!-- campo de plazas totales -->
                <div>
                    <label class="block text-sm font-bold text-[#1a4d2e] uppercase mb-2">Plazas totales</label>
                    <input type="number" name="plazas_totales" required min="1" value="<?php echo intval($quedada['plazas_totales'] ?? 0); ?>"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#1a4d2e] outline-none transition"
                           placeholder="Ej: 30">
                </div>

                <!-- botones de guardar y cancelar -->
                <div class="flex flex-col md:flex-row gap-4">
                    <!-- botón guardar: envía el formulario al controlador de edición -->
                    <button type="submit" class="flex-1 bg-[#1a4d2e] text-white py-4 rounded-2xl font-bold hover:bg-[#143a24] transition">Guardar</button>
                    <!-- botón cancelar: vuelve al panel sin guardar cambios -->
                    <form method="POST" action="../Controlador/controlador_admin.php" class="flex-1">
                        <input type="hidden" name="tab" value="quedadas">
                        <button type="submit" class="w-full text-center py-4 rounded-2xl border border-gray-200 text-gray-500 font-bold hover:bg-gray-50 transition">Cancelar</button>
                    </form>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include '../Partes/footer.php'; ?>