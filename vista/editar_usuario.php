<?php
// vista del formulario de edición de perfil, espera que el controlador le pase $usuario_datos
if (!isset($usuario_datos)) {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    header('Location: ../Controlador/controlador_editar_usuario.php');
    exit();
}

include '../partes/header.php';
?>

<?php
// mostramos los mensajes de éxito o error que el controlador haya guardado en sesión
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
if (!empty($_SESSION['mensaje_exito'])) {
    echo '<div class="max-w-3xl mx-auto px-4 mt-4">'
        . '<div class="p-4 bg-green-50 border border-green-200 text-green-800 rounded">' . htmlspecialchars($_SESSION['mensaje_exito']) . '</div>'
        . '</div>';
    unset($_SESSION['mensaje_exito']);
}
if (!empty($_SESSION['mensaje_error'])) {
    echo '<div class="max-w-3xl mx-auto px-4 mt-4">'
        . '<div class="p-4 bg-red-50 border border-red-200 text-red-800 rounded">' . htmlspecialchars($_SESSION['mensaje_error']) . '</div>'
        . '</div>';
    unset($_SESSION['mensaje_error']);
}
?>

<main class="flex-grow bg-gray-50 pt-24 pb-24">
    <!-- página de edición de perfil de usuario -->
    <div class="max-w-3xl mx-auto px-4">
        
        <!-- encabezado con enlace de volver y título -->
        <div class="mb-8">
            <a href="../vista/perfil_usuario.php" class="text-sm text-gray-400 hover:text-[#1a4d2e] transition-colors flex items-center gap-2 group">
                <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i> 
                Volver a mi perfil
            </a>
            <h2 class="text-3xl font-serif font-bold text-[#1a4d2e] mt-4">Configuración de Cuenta</h2>
            <p class="text-gray-500 text-sm">Actualiza tu información personal y contraseña.</p>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- formulario principal: envía los datos al controlador con enctype para permitir subida de archivos -->
            <form action="../Controlador/controlador_editar_usuario.php" method="POST" enctype="multipart/form-data">
                <!-- campo oculto para que el controlador sepa que debe guardar el perfil -->
                <input type="hidden" name="accion" value="guardar_perfil">

                <!-- sección de la foto de perfil -->
                <div class="p-8 border-b border-gray-50 bg-gray-50/50 flex flex-col items-center">
                    <!-- círculo con la foto actual del usuario tomada de la sesión -->
                    <div class="w-32 h-32 rounded-full border-4 border-white shadow-md overflow-hidden bg-white mb-4">
                        <img id="preview" src="../assets/imagenes/<?php echo $_SESSION['foto_perfil']; ?>" 
                             class="w-full h-full object-cover">
                    </div>

                    <!-- etiqueta que actúa como botón para abrir el selector de archivos -->
                    <label for="input_foto" class="text-[#D2691E] font-bold text-sm hover:text-[#b85c1a] cursor-pointer flex items-center gap-2 transition-colors">
                        <i class="fa-solid fa-image"></i>
                        Cambiar foto de perfil
                    </label>
                    
                    <!-- input de archivo oculto visualmente, se activa al pulsar la etiqueta de arriba -->
                    <input type="file" name="nueva_foto" id="input_foto" accept="image/*" class="hidden">
                </div>

                <div class="p-8 space-y-8">
                    <!-- sección para cambiar el nombre de usuario -->
                    <div class="space-y-4">
                        <h3 class="text-sm font-bold text-[#1a4d2e] uppercase border-l-4 border-[#D2691E] pl-3">Nombre de Usuario</h3>
                        <!-- campo prellenado con el nombre de usuario actual -->
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                                <i class="fa-solid fa-user text-sm"></i>
                            </span>
                            <input type="text" name="nuevo_usuario" 
                                   value="<?php echo htmlspecialchars($usuario_datos['usuario']); ?>" 
                                   class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#1a4d2e] outline-none transition">
                        </div>
                    </div>

                    <!-- sección para cambiar la contraseña, si se deja vacío no se modifica -->
                    <div class="space-y-4 pt-4">
                        <h3 class="text-sm font-bold text-[#1a4d2e] uppercase border-l-4 border-[#D2691E] pl-3">Cambiar Contraseña</h3>
                        
                        <!-- dos campos en paralelo: nueva contraseña y confirmación -->
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

                    <!-- botones de guardar y descartar cambios -->
                    <div class="pt-6 flex flex-col md:flex-row gap-4">
                        <button type="submit" class="flex-grow bg-[#1a4d2e] text-white font-bold py-4 rounded-2xl hover:bg-[#143a22] transition-all transform active:scale-[0.98] shadow-lg shadow-green-900/20">
                            Guardar Cambios
                        </button>
                        <!-- descartar vuelve al perfil sin enviar el formulario -->
                        <a href="perfil_usuario.php" class="px-8 py-4 border border-gray-200 text-gray-400 font-bold rounded-2xl hover:bg-gray-50 transition text-center">
                            Descartar
                        </a>
                    </div>
                </div>
            </form>

            <script>
                // cogemos el input de archivo y la imagen de previsualización por su id
                const inputFoto = document.getElementById('input_foto');
                const preview = document.getElementById('preview');

                // escuchamos el evento change: se dispara cuando el usuario selecciona una imagen
                inputFoto.addEventListener('change', function() {
                    const file = this.files[0]; // cogemos el primer archivo seleccionado
                    if (!file) return; // si no hay archivo no hacemos nada

                    // filereader lee el archivo localmente sin subirlo al servidor todavía
                    const reader = new FileReader();

                    // cuando termina de leer, asignamos el resultado como src de la imagen
                    // esto actualiza la previsualización al instante sin recargar la página
                    reader.onload = function(event) {
                        preview.src = event.target.result;
                    };

                    // le decimos al reader que lea el archivo como una url en base64
                    reader.readAsDataURL(file);
                });
            </script>
        </div>
    </div>
</main>

<?php include '../partes/footer.php'; ?>