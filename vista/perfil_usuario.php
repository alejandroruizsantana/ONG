<?php


include '../partes/header.php';
require_once '../conexion/conexion_base_datos.php';
require_once '../modelo/modelo_usuarios.php';

// Protección de ruta: Si no hay sesión, al login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// Obtener datos del usuario de la base de datos
$usuario_datos = obtener_usuario_por_id($conexion, $_SESSION['id']);

if (!$usuario_datos) {
    header("Location: login.php");
    exit;
}

// Asignar valores con seguridad
$_SESSION['foto'] = $usuario_datos['foto'] ?? 'avatar_default.png';
$_SESSION['rol'] = $usuario_datos['rol'];
?>

<main class="flex-grow bg-gray-50 pt-12 pb-24">
    <div class="max-w-5xl mx-auto px-4">
        
        <!-- 1. CABECERA DEL PERFIL -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-8">
            <div class="h-32 bg-[#1a4d2e]"></div> <!-- Fondo decorativo verde -->
            <div class="px-8 pb-8">
                <div class="relative flex flex-col md:flex-row items-center md:items-end -mt-16 gap-6">
                    <!-- Foto de Perfil -->
                    <div class="w-32 h-32 rounded-full border-4 border-white overflow-hidden shadow-lg bg-white">
                        <img src="../assets/imagenes/<?php echo $_SESSION['foto']; ?>" alt="Perfil" class="w-full h-full object-cover">
                    </div>
                    <!-- Info Usuario -->
                    <div class="flex-grow text-center md:text-left mb-2">
                        <h2 class="text-3xl font-serif font-bold text-[#1a4d2e]"><?php echo $_SESSION['usuario']; ?></h2>
                        <p class="text-gray-500 flex items-center justify-center md:justify-start gap-2">
                            <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-0.5 rounded-full uppercase">
                                <?php echo $_SESSION['rol']; ?>
                            </span>
                            • Miembro desde 2024
                        </p>
                    </div>
                    <!-- Botón editar rápido -->
                    <button class="mb-2 bg-white border border-gray-300 px-4 py-2 rounded-xl text-sm font-bold hover:bg-gray-50 transition">
                        <i class="fa-solid fa-pen-to-square mr-2"></i> Editar Perfil
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- COLUMNA IZQUIERDA: ESTADÍSTICAS Y DATOS -->
            <div class="md:col-span-1 space-y-8">
                <!-- Tarjeta Estadísticas -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                    <h4 class="font-bold text-[#1a4d2e] mb-4">Mi Actividad</h4>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-orange-50 rounded-2xl">
                            <span class="text-sm font-medium text-gray-600">Quedadas</span>
                            <span class="text-xl font-bold text-[#D2691E]">3</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-green-50 rounded-2xl">
                            <span class="text-sm font-medium text-gray-600">Donado</span>
                            <span class="text-xl font-bold text-[#1a4d2e]">25€</span>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta Seguridad -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 text-center">
                    <i class="fa-solid fa-shield-halved text-3xl text-gray-300 mb-3"></i>
                    <h4 class="font-bold text-gray-700 mb-2">Seguridad</h4>
                    <p class="text-xs text-gray-500 mb-4">Mantén tu cuenta protegida cambiando tu contraseña regularmente.</p>
                    <a href="#" class="text-[#D2691E] font-bold text-sm hover:underline">Cambiar contraseña</a>
                </div>
            </div>

            <!-- COLUMNA DERECHA: PRÓXIMAS QUEDADAS -->
            <div class="md:col-span-2">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 h-full">
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="text-xl font-serif font-bold text-[#1a4d2e]">Mis Inscripciones</h3>
                        <a href="quedada.php" class="text-sm text-[#D2691E] font-bold">Ver más eventos</a>
                    </div>

                    <!-- Lista de quedadas (Vacío por ahora) -->
                    <div class="flex flex-col items-center justify-center py-12 text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fa-solid fa-calendar-day text-gray-400 text-2xl"></i>
                        </div>
                        <p class="text-gray-500 font-medium">Aún no te has apuntado a ninguna quedada.</p>
                        <p class="text-gray-400 text-sm mt-1">¡El lince te necesita! Revisa los próximos eventos.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<?php include '../partes/footer.php'; ?>