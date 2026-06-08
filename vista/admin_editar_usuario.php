<?php
// Página de edición de usuario desde el panel admin. Permite al admin actualizar datos de otro usuario.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Esta vista espera que el controlador prepare la variable $usuarioDatos.
if (!isset($usuarioDatos) || !$usuarioDatos) {
    $_SESSION['activeTab'] = 'usuarios';
    header('Location: ../Controlador/controlador_admin.php');
    exit;
}

include '../Partes/header.php';
?>

<main class="flex-grow bg-gray-50 pt-24 pb-24">
    <!-- Página de edición de usuario en el panel admin -->
    <div class="max-w-3xl mx-auto px-4">
        <div class="mb-8">
            <form method="POST" action="../Controlador/controlador_admin.php" class="inline">
                <input type="hidden" name="tab" value="usuarios">
                <button type="submit" class="text-sm text-gray-400 hover:text-[#1a4d2e] transition-colors flex items-center gap-2 group bg-transparent border-0">
                    <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                    Volver a Gestión de Usuarios
                </button>
            </form>
            <h2 class="text-3xl font-serif font-bold text-[#1a4d2e] mt-4">Editar Usuario</h2>
            <p class="text-gray-500 text-sm">Modifica los datos del usuario seleccionado.</p>
        </div>

        <!-- Formulario para modificar datos del usuario seleccionado -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <form action="../Controlador/controlador_admin.php" method="POST" class="p-8 space-y-6">
                <input type="hidden" name="accion" value="guardar_usuario">
                <input type="hidden" name="id_usuario" value="<?php echo $usuarioDatos['id']; ?>">

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Usuario</label>
                    <input type="text" name="usuario" value="<?php echo htmlspecialchars($usuarioDatos['usuario']); ?>" class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-[#1a4d2e] outline-none">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($usuarioDatos['email']); ?>" class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-[#1a4d2e] outline-none">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Rol</label>
                    <select name="rol" class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-[#1a4d2e] outline-none">
                        <option value="usuario" <?php echo $usuarioDatos['rol'] === 'usuario' ? 'selected' : ''; ?>>Usuario</option>
                        <option value="admin" <?php echo $usuarioDatos['rol'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>

                <div class="flex flex-col md:flex-row gap-4">
                        <button type="submit" class="flex-1 bg-[#1a4d2e] text-white py-3 rounded-2xl font-bold hover:bg-[#143a24] transition">Guardar</button>
                    <a href="../Controlador/controlador_admin.php" class="flex-1 text-center py-3 rounded-2xl border border-gray-200 text-gray-500 font-bold hover:bg-gray-50 transition">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include '../Partes/footer.php'; ?>