<?php
// Esta vista espera que `Controlador/controlador_admin.php` prepare las variables:
// $resultadoAdmin, $usuariosAdmin, $activeTab, $totalQuedadasCount, $totalUsuariosCount, $totalPlazasOcupadas
// Esta vista debe ser provista por `Controlador/controlador_admin.php`.
// Si se accede directamente sin que el controlador prepare los datos, redirigimos a él.
if (!isset($resultadoAdmin) || !isset($totalQuedadasCount)) {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    // mantener la pestaña solicitada (si viene por POST) o usar la por defecto
    if (isset($_POST['tab'])) {
        $_SESSION['activeTab'] = $_POST['tab'];
    } elseif (!isset($_SESSION['activeTab'])) {
        $_SESSION['activeTab'] = 'quedadas';
    }
    header('Location: ../Controlador/controlador_admin.php');
    exit();
}

include '../Partes/header.php'; 
?>

<main class="flex-grow bg-[#f8f7f4] py-20">
    <div class="max-w-7xl mx-auto px-4">
        
        <div class="flex justify-between items-center mb-12">
            <div>
                <h1 class="text-4xl font-serif font-bold text-[#1a4d2e]">Panel de Administración</h1>
                <p class="text-gray-500 mt-2">Gestión de voluntarios y control de aforo de las quedadas.</p>
            </div>
            <a href="../vista/crear_quedada.php" class="bg-[#1a4d2e] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#143d24] transition-colors">
                + Nueva Quedada
            </a>
        </div>

        <?php // Las métricas y datos son provistas por el controlador (Controlador/controlador_admin.php) ?>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-sm p-6 flex items-center gap-4 border border-gray-100">
                <div class="w-12 h-12 rounded-lg bg-[#D2691E] flex items-center justify-center text-white text-xl font-bold">Q</div>
                <div>
                    <div class="text-xs text-gray-400 uppercase font-semibold">Quedadas</div>
                    <div class="text-2xl font-bold text-[#1a4d2e]"><?php echo $totalQuedadasCount; ?></div>
                    <div class="text-sm text-gray-500">Eventos creados</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-6 flex items-center gap-4 border border-gray-100">
                <div class="w-12 h-12 rounded-lg bg-[#1a4d2e] flex items-center justify-center text-white text-xl font-bold">U</div>
                <div>
                    <div class="text-xs text-gray-400 uppercase font-semibold">Usuarios</div>
                    <div class="text-2xl font-bold text-[#1a4d2e]"><?php echo $totalUsuariosCount; ?></div>
                    <div class="text-sm text-gray-500">Cuentas registradas</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-6 flex items-center gap-4 border border-gray-100">
                <div class="w-12 h-12 rounded-lg bg-[#297849] flex items-center justify-center text-white text-xl font-bold">P</div>
                <div>
                    <div class="text-xs text-gray-400 uppercase font-semibold">Plazas ocupadas</div>
                    <div class="text-2xl font-bold text-[#1a4d2e]"><?php echo $totalPlazasOcupadas; ?></div>
                    <div class="text-sm text-gray-500">Voluntarios inscritos</div>
                </div>
            </div>
        </div>

        <!-- Controles superiores (creación de quedada ya disponible arriba) -->

        <?php if (isset($_SESSION['mensaje_exito'])): ?>
            <div class="mb-8 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-xl shadow-sm flex items-center gap-3">
                <i class="fa-solid fa-check-double"></i>
                <span class="font-medium"><?php echo $_SESSION['mensaje_exito']; unset($_SESSION['mensaje_exito']); ?></span>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['mensaje_error'])): ?>
            <div class="mb-8 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-xl shadow-sm flex items-center gap-3">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span class="font-medium"><?php echo $_SESSION['mensaje_error']; unset($_SESSION['mensaje_error']); ?></span>
            </div>
        <?php endif; ?>

        <div class="flex flex-wrap gap-3 mb-8">
            <form method="POST" action="../Controlador/controlador_admin.php" class="inline">
                <input type="hidden" name="tab" value="quedadas">
                <button type="submit" class="px-5 py-3 rounded-full font-bold transition-colors <?= $activeTab === 'quedadas' ? 'bg-[#1a4d2e] text-white' : 'bg-white text-[#1a4d2e] border border-gray-200 hover:bg-[#1a4d2e] hover:text-white' ?>">Gestionar Quedadas</button>
            </form>
            <form method="POST" action="../Controlador/controlador_admin.php" class="inline">
                <input type="hidden" name="tab" value="usuarios">
                <button type="submit" class="px-5 py-3 rounded-full font-bold transition-colors <?= $activeTab === 'usuarios' ? 'bg-[#1a4d2e] text-white' : 'bg-white text-[#1a4d2e] border border-gray-200 hover:bg-[#1a4d2e] hover:text-white' ?>">Gestionar Usuarios</button>
            </form>
        </div>

        <?php if ($activeTab === 'quedadas'): ?>
            <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                <table class="w-full text-left min-w-[720px]">
                    <thead class="bg-gradient-to-r from-white to-gray-50 border-b border-gray-100">
                        <tr class="text-sm font-semibold text-gray-500 uppercase tracking-wider">
                            <th class="p-4 md:p-6">Evento / Ubicación</th>
                            <th class="p-4 md:p-6">Fecha y Hora</th>
                            <th class="p-4 md:p-6 text-center">Ocupación</th>
                            <th class="p-4 md:p-6 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 bg-white">
                        <?php if ($resultadoAdmin && mysqli_num_rows($resultadoAdmin) > 0): 
                            while ($q = mysqli_fetch_assoc($resultadoAdmin)): 
                                $porcentaje = ($q['plazas_totales'] > 0) ? round(($q['plazas_ocupadas'] / $q['plazas_totales']) * 100) : 0;
                    ?>
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="p-4 md:p-6 align-top">
                                <div class="font-bold text-[#1a4d2e] text-lg"><?php echo htmlspecialchars($q['titulo']); ?></div>
                                <div class="text-gray-500 text-sm mt-1"><?php echo htmlspecialchars(substr($q['descripcion'] ?? '', 0, 100)); ?><?php echo (strlen($q['descripcion'] ?? '')>100) ? '...' : ''; ?></div>
                                <div class="text-gray-400 text-xs flex items-center gap-2 mt-3">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span><?php echo htmlspecialchars($q['provincia']); ?></span>
                                </div>
                            </td>
                            <td class="p-4 md:p-6 text-sm text-gray-600 align-top">
                                <div class="font-medium"><?php echo date("d M Y", strtotime($q['fecha'])); ?></div>
                                <div class="text-gray-400"><?php echo date("H:i", strtotime($q['hora_inicio'])); ?>h</div>
                            </td>
                            <td class="p-4 md:p-6 align-top">
                                <div class="flex items-center gap-3">
                                    <div class="flex-1">
                                        <div class="text-xs text-gray-400">Ocupación</div>
                                        <div class="text-sm font-semibold text-[#1a4d2e]"><?php echo $q['plazas_ocupadas']; ?> / <?php echo $q['plazas_totales']; ?></div>
                                    </div>
                                    <div class="w-32 bg-gray-100 h-2 rounded-full overflow-hidden">
                                        <div class="bg-[#D2691E] h-full" style="width: <?php echo $porcentaje; ?>%"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 md:p-6 text-right align-top">
                                <div class="flex justify-end items-center gap-3">
                                    <form action="../Controlador/controlador_admin.php" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar esta quedada? Esta acción no se puede deshacer.');">
                                        <input type="hidden" name="accion" value="borrar_quedada">
                                        <input type="hidden" name="id_quedada" value="<?php echo $q['id']; ?>">
                                        <button type="submit" class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-red-50 text-red-600 hover:bg-red-100 transition" title="Eliminar Quedada">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; else: ?>
                        <tr>
                            <td colspan="4" class="p-10 text-center text-gray-400 italic">No hay eventos creados todavía.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php else: ?>
            <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                <table class="w-full text-left min-w-[720px]">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="p-6 text-sm font-bold text-gray-400 uppercase tracking-wider">ID</th>
                            <th class="p-6 text-sm font-bold text-gray-400 uppercase tracking-wider">Usuario</th>
                            <th class="p-6 text-sm font-bold text-gray-400 uppercase tracking-wider">Email</th>
                            <th class="p-6 text-sm font-bold text-gray-400 uppercase tracking-wider">Rol</th>
                            <th class="p-6 text-sm font-bold text-gray-400 uppercase tracking-wider text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php if ($usuariosAdmin && mysqli_num_rows($usuariosAdmin) > 0): ?>
                            <?php while ($usuario = mysqli_fetch_assoc($usuariosAdmin)): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="p-6 text-sm text-gray-600"><?php echo $usuario['id']; ?></td>
                                    <td class="p-6 text-sm text-gray-600"><?php echo htmlspecialchars($usuario['usuario']); ?></td>
                                    <td class="p-6 text-sm text-gray-600"><?php echo htmlspecialchars($usuario['email']); ?></td>
                                    <td class="p-6 text-sm align-middle">
                                        <?php $role = htmlspecialchars($usuario['rol']); ?>
                                        <?php if ($role === 'admin'): ?>
                                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-700">Admin</span>
                                        <?php else: ?>
                                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">Usuario</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="p-6 text-right">
                                        <div class="flex justify-end gap-2">
                                            <form method="POST" action="../Controlador/controlador_admin.php" class="inline">
                                                <input type="hidden" name="accion" value="editar_usuario">
                                                <input type="hidden" name="id_usuario" value="<?php echo $usuario['id']; ?>">
                                                <button type="submit" class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-[#1a4d2e] text-white hover:bg-[#143a24] transition" title="Editar">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                            </form>
                                            <form action="../Controlador/controlador_admin.php" method="POST" onsubmit="return confirm('¿Eliminar este usuario? Esta acción no se puede deshacer.')" class="inline">
                                                <input type="hidden" name="accion" value="eliminar_usuario">
                                                <input type="hidden" name="id_usuario" value="<?php echo $usuario['id']; ?>">
                                                <button type="submit" class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-red-50 text-red-600 hover:bg-red-100 transition" title="Borrar">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="p-10 text-center text-gray-400 italic">No hay usuarios registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php include '../Partes/footer.php'; ?>