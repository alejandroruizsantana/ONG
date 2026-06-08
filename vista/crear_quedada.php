<?php
// Página de creación de quedadas. Formulario para crear un nuevo evento de limpieza.
include '../Partes/header.php';
?>

<main class="flex-grow bg-[#f8f7f4] py-20">
    <div class="max-w-4xl mx-auto px-4">
        <div class="mb-8">
            <a href="../Controlador/controlador_admin.php" class="text-sm text-gray-400 hover:text-[#1a4d2e] transition-colors flex items-center gap-2 group">
                <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i> 
                Volver al panel
            </a>
            <h2 class="text-3xl font-serif font-bold text-[#1a4d2e] mt-4">Nueva Quedada</h2>
            <p class="text-gray-500 text-sm">Crea un nuevo evento de limpieza para los voluntarios.</p>
        </div>

        <!-- Errores de validación del formulario -->
        <?php if (!empty($_SESSION['errores_creacion'])): ?>
            <div class="mb-8 bg-red-50 border border-red-200 rounded-xl p-4">
                <div class="text-red-700 font-semibold mb-2">Errores en el formulario:</div>
                <ul class="list-disc list-inside text-red-600 text-sm">
                    <?php foreach ($_SESSION['errores_creacion'] as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php unset($_SESSION['errores_creacion']); ?>
        <?php endif; ?>

        <!-- Formulario para crear una nueva quedada -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
            <form action="../Controlador/controlador_crear_quedada.php" method="POST">
                <!-- Título -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-[#1a4d2e] uppercase mb-2">Título del evento</label>
                    <input type="text" name="titulo" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#1a4d2e] outline-none transition"
                           placeholder="Ej: Limpieza de Sierra Morena">
                </div>

                <!-- Descripción -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-[#1a4d2e] uppercase mb-2">Descripción</label>
                    <textarea name="descripcion" rows="4"
                              class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#1a4d2e] outline-none transition"
                              placeholder="Describe el evento, actividades, recomendaciones..."></textarea>
                </div>

                <!-- Fecha y horas -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-[#1a4d2e] uppercase mb-2">Fecha</label>
                        <input type="date" name="fecha" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#1a4d2e] outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#1a4d2e] uppercase mb-2">Hora inicio</label>
                        <input type="time" name="hora_inicio" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#1a4d2e] outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#1a4d2e] uppercase mb-2">Hora fin</label>
                        <input type="time" name="hora_fin" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#1a4d2e] outline-none transition">
                    </div>
                </div>

                <!-- Ubicación y provincia -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-[#1a4d2e] uppercase mb-2">Ubicación</label>
                        <input type="text" name="ubicacion" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#1a4d2e] outline-none transition"
                               placeholder="Ej: Parque Natural...">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#1a4d2e] uppercase mb-2">Provincia</label>
                        <input type="text" name="provincia" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#1a4d2e] outline-none transition"
                               placeholder="Ej: Jaén">
                    </div>
                </div>

                <!-- Plazas totales -->
                <div class="mb-8">
                    <label class="block text-sm font-bold text-[#1a4d2e] uppercase mb-2">Plazas totales</label>
                    <input type="number" name="plazas_totales" required min="1"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#1a4d2e] outline-none transition"
                           placeholder="Ej: 30">
                </div>

                <!-- Botones -->
                <div class="flex gap-4">
                    <button type="submit" class="flex-grow bg-[#1a4d2e] text-white font-bold py-4 rounded-2xl hover:bg-[#143a22] transition-all transform active:scale-[0.98] shadow-lg shadow-green-900/20">
                        Crear Quedada
                    </button>
                    <a href="../Controlador/controlador_admin.php" class="px-8 py-4 border border-gray-200 text-gray-400 font-bold rounded-2xl hover:bg-gray-50 transition text-center">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include '../Partes/footer.php'; ?>
