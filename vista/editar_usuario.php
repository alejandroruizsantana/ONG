<?php
include '../partes/header.php';
require_once '../conexion/conexion_base_datos.php';
require_once '../modelo/modelo_usuarios.php';

// Si no hay sesión, al login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// Obtener datos actuales del usuario
$usuario_datos = obtener_usuario_por_id($conexion, $_SESSION['id']);
?>

<main class="flex-grow bg-gray-50 pt-24 pb-24">
    <div class="max-w-3xl mx-auto px-4">
        
        <!-- ENCABEZADO -->
        <div class="mb-8">
            <a href="perfil_usuario.php" class="text-sm text-gray-400 hover:text-[#1a4d2e] transition-colors flex items-center gap-2 group">
                <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i> 
                Volver a mi perfil
            </a>
            <h2 class="text-3xl font-serif font-bold text-[#1a4d2e] mt-4">Configuración de Cuenta</h2>
            <p class="text-gray-500 text-sm">Actualiza tu información personal y contraseña.</p>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Formulario -->
            <form action="../controlador/controlador_editar_perfil.php" method="POST">
                
                <!-- CAMBIAR IMAGEN DE PERFIL -->
                <div class="p-8 border-b border-gray-50 bg-gray-50/50 flex flex-col items-center">
                    <!-- Círculo de la foto -->
                    <div class="w-32 h-32 rounded-full border-4 border-white shadow-md overflow-hidden bg-white mb-4">
                        <img id="preview" src="../assets/imagenes/<?php echo $_SESSION['foto_perfil']; ?>" 
                             class="w-full h-full object-cover">
                    </div>

                    <!-- Enlace para activar el input -->
                    <label for="input_foto" class="text-[#D2691E] font-bold text-sm hover:text-[#b85c1a] cursor-pointer flex items-center gap-2 transition-colors">
                        <i class="fa-solid fa-image"></i>
                        Cambiar foto de perfil
                    </label>
                    
                    <!-- Input hidden para la foto -->
                    <input type="file" name="nueva_foto" id="input_foto" class="hidden">
                    
                    
                </div>

                <div class="p-8 space-y-8">
                    <!-- DATOS GENERALES -->
                    <div class="space-y-4">
                        <h3 class="text-sm font-bold text-[#1a4d2e] uppercase  border-l-4 border-[#D2691E] pl-3">Nombre de Usuario</h3>
                        
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                                <i class="fa-solid fa-user text-sm"></i>
                            </span>
                            <input type="text" name="nuevo_usuario" 
                                   value="<?php echo htmlspecialchars($usuario_datos['usuario']); ?>" 
                                   class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#1a4d2e]  outline-none transition">
                        </div>
                    </div>

                    <!-- CAMBIAR CONTRASEÑA -->
                    <div class="space-y-4 pt-4">
                        <h3 class="text-sm font-bold text-[#1a4d2e] uppercase  border-l-4 border-[#D2691E] pl-3">Cambiar Contraseña</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Nueva contraseña</label>
                                <input type="password" name="nueva_pass" placeholder="••••••••"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#1a4d2e] outline-none transition">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Confirmar nueva</label>
                                <input type="password" name="confirmar_pass" placeholder="••••••••"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#1a4d2e] outline-none transition">
                            </div>
                        </div>
                        <p class="text-[11px] text-gray-400 italic bg-blue-50 p-2 rounded-lg">
                            <i class="fa-solid fa-info-circle mr-1"></i>
                            Deja estos campos vacíos si no quieres cambiar tu contraseña.
                        </p>
                    </div>

                    <!-- BOTONES DE ACCIÓN -->
                    <div class="pt-6 flex flex-col md:flex-row gap-4">
                        <button type="submit" class="flex-grow bg-[#1a4d2e] text-white font-bold py-4 rounded-2xl hover:bg-[#143a22] transition-all transform active:scale-[0.98] shadow-lg shadow-green-900/20">
                            Guardar Cambios
                        </button>
                        <a href="perfil_usuario.php" class="px-8 py-4 border border-gray-200 text-gray-400 font-bold rounded-2xl hover:bg-gray-50 transition text-center">
                            Descartar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>



<?php include '../partes/footer.php'; ?>