<?php
/* INCLUIMOS EL HEADER */
include '../partes/header.php';
?>

<main class="flex-grow bg-[#f8f7f4] pt-28 pb-24 font-sans">
    <div class="max-w-3xl mx-auto px-4">
        
        <div class="text-center mb-12">
            <span class="bg-amber-100 text-amber-800 text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-wider">
                <i class="fa-solid fa-heart mr-1"></i> Tu Apoyo Importa
            </span>
            <h2 class="text-4xl font-serif font-bold text-[#1a4d2e] mt-4 mb-4">
                Haz una Donación por el Lince
            </h2>
            <p class="text-gray-600 max-w-xl mx-auto leading-relaxed">
                Cada aportación se destina íntegramente a la protección de los cachorros, la restauración de bosques y el monitoreo biológico en Doñana y Sierra de Andújar.
            </p>
        </div>

        <form action="../Controlador/controlador_donacion.php" method="POST" class="space-y-8">
            
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                <h3 class="text-xl font-serif font-bold text-[#1a4d2e] mb-6 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-full bg-[#1a4d2e] text-white flex items-center justify-center text-xs font-sans">1</span>
                    ¿Cuánto deseas donar?
                </h3>
                
                <div class="max-w-md">
                    <label for="cantidad_donar" class="block text-sm font-bold text-gray-700 mb-3">Introduce el importe de tu donación (€)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                            <span class="text-gray-400 font-bold text-xl">€</span>
                        </div>
                        <input type="number" 
                               name="cantidad" 
                               id="cantidad_donar" 
                               min="1" 
                               required 
                               placeholder="Ej. 20" 
                               class="block w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-2xl focus:ring-amber-500 focus:border-amber-500 text-xl font-semibold transition-all">
                    </div>
                    <p class="text-xs text-gray-400 mt-2">Puedes introducir cualquier cantidad entera a partir de 1€.</p>
                </div>
            </div>

            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                <h3 class="text-xl font-serif font-bold text-[#1a4d2e] mb-6 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-full bg-[#1a4d2e] text-white flex items-center justify-center text-xs font-sans">2</span>
                    Tus Datos personales
                </h3>

                <?php if (isset($_SESSION['usuario'])): ?>
                    <div class="p-5 bg-green-50 text-green-800 rounded-2xl text-sm flex items-center gap-3 border border-green-100">
                        <i class="fa-solid fa-circle-check text-green-600 text-xl"></i>
                        <span>¡Hola, <strong><?php echo $_SESSION['usuario']; ?></strong>! Hemos reconocido tu cuenta. Tu donación se asociará automáticamente a tu perfil para sumar puntos de logro.</span>
                    </div>
                    
                    <input type="hidden" name="nombre" value="<?php echo $_SESSION['usuario']; ?>">
                    <input type="hidden" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">

                <?php else: ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre completo</label>
                            <input type="text" name="nombre" required placeholder="Tu nombre" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-amber-500 focus:border-amber-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Correo electrónico</label>
                            <input type="email" name="email" required placeholder="correo@ejemplo.com" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-amber-500 focus:border-amber-500">
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-4">
                        ¿Ya tienes cuenta? <a href="login.php" class="text-[#D2691E] font-bold hover:underline">Inicia sesión antes de donar</a> para acumular tus puntos.
                    </p>
                <?php endif; ?>
            </div>

            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                <h3 class="text-xl font-serif font-bold text-[#1a4d2e] mb-6 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-full bg-[#1a4d2e] text-white flex items-center justify-center text-xs font-sans">3</span>
                    Método de pago
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <label class="flex items-center justify-between p-4 border-2 border-amber-500 bg-amber-50/10 rounded-xl cursor-pointer">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-credit-card text-2xl text-[#1a4d2e]"></i>
                            <span class="font-semibold text-sm text-gray-700">Tarjeta de Crédito / Débito</span>
                        </div>
                        <input type="radio" name="metodo_pago" value="tarjeta" checked class="accent-amber-500">
                    </label>

                    <label class="flex items-center justify-between p-4 border border-gray-200 rounded-xl cursor-pointer hover:border-amber-500 transition-colors">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-mobile-screen-button text-2xl text-cyan-600"></i>
                            <span class="font-semibold text-sm text-gray-700">Bizum</span>
                        </div>
                        <input type="radio" name="metodo_pago" value="bizum" class="accent-amber-500">
                    </label>
                </div>

                <div class="mt-8">
                    <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold text-lg py-4 rounded-2xl shadow-md transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-heart-circle-check"></i> Confirmar y Realizar Donación
                    </button>
                    <p class="text-center text-xs text-gray-400 mt-3 flex items-center justify-center gap-1">
                        <i class="fa-solid fa-lock text-gray-300"></i> Transacción cifrada bajo entorno seguro.
                    </p>
                </div>
            </div>

        </form>
    </div>
</main>

<?php 
/* INCLUIMOS EL FOOTER */
include '../partes/footer.php'; 
?>