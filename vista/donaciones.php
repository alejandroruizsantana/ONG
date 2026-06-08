<?php
// Página de donaciones. Muestra monto elegido y envía la donación al controlador.
// Si el usuario elige un importe rápido, se carga en el campo del formulario.
$montoSeleccionado = isset($_GET['monto']) ? intval($_GET['monto']) : null;
/* INCLUIMOS EL HEADER */
include '../Partes/header.php';
?>

<main class="flex-grow bg-[#f8f7f4] pt-28 pb-24 font-sans">
    <div class="max-w-3xl mx-auto px-4">

        <!-- CONTENEDOR PRINCIPAL DE DONACIONES -->
        <!-- CABECERA -->
        <div class="text-center mb-12">
            
            <span class="bg-amber-100 text-amber-800 text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-wider">
                <i class="fa-solid fa-heart mr-1"></i> Tu Apoyo Importa
            </span>
            
            <h2 class="text-4xl font-serif font-bold text-[#1a4d2e] mt-4 mb-4">
                Haz una Donación por el Lince
            </h2>
            
            <p class="text-gray-600 max-w-xl mx-auto leading-relaxed">
                Cada aportación se destina íntegramente a la protección de los cachorros y la restauración de bosques.
            </p>
        </div>
      

        <div class="space-y-8">

            <!-- MENSAJES DE FEEDBACK -->
            <?php // Mostramos los mensajes de éxito o error devueltos por el controlador.
            if (isset($_SESSION['mensaje_exito'])): ?>
                <div class="bg-green-50 border border-green-200 text-green-700 rounded-3xl p-6 shadow-sm">
                    <strong class="font-semibold">¡Gracias!</strong>
                    <p class="mt-2"><?php echo htmlspecialchars($_SESSION['mensaje_exito']); ?></p>
                </div>
                <?php unset($_SESSION['mensaje_exito']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['mensaje_error'])): ?>
                <div class="bg-red-50 border border-red-200 text-red-700 rounded-3xl p-6 shadow-sm">
                    <strong class="font-semibold">Error</strong>
                    <p class="mt-2"><?php echo htmlspecialchars($_SESSION['mensaje_error']); ?></p>
                </div>
                <?php unset($_SESSION['mensaje_error']); ?>
            <?php endif; ?>

            <!-- SECCIÓN 1: CANTIDAD DE LA DONACIÓN -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                <h3 class="text-xl font-serif font-bold text-[#1a4d2e] mb-6 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-full bg-[#1a4d2e] text-white flex items-center justify-center text-xs font-sans">1</span>
                    ¿Cuánto deseas donar?
                </h3>

                <div class="mb-8">
                    <label class="block text-sm font-bold text-gray-700 mb-3">Donación rápida (elige una cantidad y confirma)</label>
                    <!-- BOTONES DE DONACIÓN RÁPIDA -->
                    <div class="grid grid-cols-3 gap-3 max-w-md">
                        <a href="donaciones.php?monto=10" class="w-full inline-flex items-center justify-center py-3 px-4 bg-gray-50 border-2 border-gray-200 rounded-xl font-bold text-lg text-gray-700 hover:border-amber-500 hover:bg-amber-50/30 transition-all">
                            10€
                        </a>
                        <a href="donaciones.php?monto=20" class="w-full inline-flex items-center justify-center py-3 px-4 bg-gray-50 border-2 border-gray-200 rounded-xl font-bold text-lg text-gray-700 hover:border-amber-500 hover:bg-amber-50/30 transition-all">
                            20€
                        </a>
                        <a href="donaciones.php?monto=50" class="w-full inline-flex items-center justify-center py-3 px-4 bg-gray-50 border-2 border-gray-200 rounded-xl font-bold text-lg text-gray-700 hover:border-amber-500 hover:bg-amber-50/30 transition-all">
                            50€
                        </a>
                    </div>
                    <?php if ($montoSeleccionado): ?>
                        <p class="mt-4 text-sm text-gray-700">Has seleccionado <strong><?php echo $montoSeleccionado; ?>€</strong>. Introduce tus datos más abajo para finalizar.</p>
                    <?php else: ?>
                        <p class="mt-4 text-sm text-gray-500">Selecciona una cantidad rápida o introduce un importe personalizado más abajo.</p>
                    <?php endif; ?>
                </div>

                <!-- INICIO DEL FORMULARIO -->
                <form action="../Controlador/controlador_donacion.php" method="POST" class="space-y-8">
                    <!-- Valores implícitos para la simulación segura -->
                    <input type="hidden" name="metodo_pago" value="tarjeta">
                    <input type="hidden" name="nombre" value="<?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Anónimo'; ?>">
                    <input type="hidden" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">
                    
                    <!-- CAMPO DE IMPORTE PERSONALIZADO -->
                    <div class="max-w-md">
                        <label for="cantidad_donar" class="block text-sm font-bold text-gray-700 mb-3">O introduce otro importe personalizado (€)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                <span class="text-gray-400 font-bold text-xl">€</span>
                            </div>
                            <input type="number" 
                                   name="cantidad" 
                                   id="cantidad_donar" 
                                   min="1" 
                                   required 
                                   value="<?php echo $montoSeleccionado ? htmlspecialchars($montoSeleccionado) : ''; ?>"
                                   placeholder="Ej. 25" 
                                   class="block w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-2xl text-xl font-semibold transition-all">
                        </div>
                        <p class="text-xs text-gray-400 mt-2">Puedes introducir cualquier cantidad entera a partir de 1€.</p>
                    </div>
            </div>

            <!-- SECCIÓN 2: DATOS PERSONALES Y ENVÍO -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                <h3 class="text-xl font-serif font-bold text-[#1a4d2e] mb-6 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-full bg-[#1a4d2e] text-white flex items-center justify-center text-xs font-sans">2</span>
                    Tus Datos personales
                </h3>

                <?php if (isset($_SESSION['usuario'])): ?>
                    <!-- Usuario autenticado: no pedimos nombre ni correo extra. -->
                    <?php // Si el usuario está logueado, usamos sus datos para asociar la donación automáticamente. ?>
                    <div class="p-5 bg-green-50 text-green-800 rounded-2xl text-sm flex items-center gap-3 border border-green-100 mb-6">
                        <i class="fa-solid fa-circle-check text-green-600 text-xl"></i>
                        <span>¡Hola, <strong><?php echo $_SESSION['usuario']; ?></strong>! Hemos reconocido tu cuenta. Tu donación se asociará automáticamente a tu perfil.</span>
                    </div>

                    <input type="hidden" name="nombre" value="<?php echo $_SESSION['usuario']; ?>">
                    <input type="hidden" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">

                <?php else: ?>
                    <!-- Usuario invitado: solicitamos nombre y correo para registrar la donación. -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre completo</label>
                            <input type="text" name="nombre" required placeholder="Tu nombre" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Correo electrónico</label>
                            <input type="email" name="email" required placeholder="correo@ejemplo.com" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl">
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mb-6">
                        ¿Ya tienes cuenta? <a href="login.php" class="text-[#D2691E] font-bold hover:underline">Inicia sesión antes de donar</a> para acumular tus puntos.
                    </p>
                <?php endif; ?>

                <!-- ENVÍO DEL FORMULARIO DE DONACIÓN -->
                <div class="border-t border-gray-100 pt-6 mt-6">
                    <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold text-lg py-4 rounded-2xl shadow-md transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-heart-circle-check"></i> Confirmar Donación
                    </button>
                 
                </div>
            </div>

                </form> <!-- CIERRE DEL FORMULARIO -->
        </div>

    </div>
</main>

<?php
/* INCLUIMOS EL FOOTER */
include '../Partes/footer.php';
?>