<?php
// Página de recompensas. Muestra el progreso de donaciones y las recompensas obtenidas.
// El controlador prepara los datos del usuario y la meta activa.
include_once '../Controlador/controlador_recompensas.php';
// Header común con navegación y estilos.
include '../Partes/header.php'; 
?>

<main class="flex-grow bg-[#f8f7f4]">
    <!-- Página de recompensas: seguimiento del objetivo y niveles -->

    <?php if (isset($_SESSION['mensaje_exito'])): ?>
        <div class="max-w-6xl mx-auto mt-6 px-4">
            <div class="bg-green-50 border border-green-200 text-green-700 rounded-3xl p-5 shadow-sm">
                <strong class="font-semibold">¡Donación recibida!</strong>
                <p class="mt-2"><?php echo htmlspecialchars($_SESSION['mensaje_exito']); ?></p>
            </div>
        </div>
        <?php unset($_SESSION['mensaje_exito']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['mensaje_error'])): ?>
        <div class="max-w-6xl mx-auto mt-6 px-4">
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-3xl p-5 shadow-sm">
                <strong class="font-semibold">Error</strong>
                <p class="mt-2"><?php echo htmlspecialchars($_SESSION['mensaje_error']); ?></p>
            </div>
        </div>
        <?php unset($_SESSION['mensaje_error']); ?>
    <?php endif; ?>

    <!-- CABECERA -->
    <section class="pt-32 pb-16 px-4 text-center">
        <div class="max-w-4xl mx-auto">
            <span class="bg-orange-100 text-[#D2691E] text-xs font-bold px-4 py-1.5 rounded-full uppercase mb-6 inline-block">
                Programa de recompensas
            </span>
            <h1 class="text-5xl md:text-6xl font-serif font-bold text-[#1a4d2e] mb-6">
                Recompensas y Objetivos
            </h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Tu apoyo marca la diferencia. Descubre las recompensas exclusivas que puedes obtener al contribuir a la conservación del lince.
            </p>
        </div>
    </section>

    <!-- OBJETIVO DE RECAUDACIÓN -->
    <section class="pb-20 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="bg-[#1a4d2e] p-10 rounded-3xl shadow-2xl text-white relative overflow-hidden transition-transform duration-300 hover:scale-105">
                <div class="relative z-10">
                    <h3 class="text-3xl font-serif font-bold mb-2"><?php echo htmlspecialchars($titulo_objetivo); ?></h3>
                    <p class="opacity-80 text-xl mb-10"><?php echo htmlspecialchars($descripcion_objetivo); ?></p>

                    <div class="flex justify-between items-end mb-4">
                        <span class="text-sm font-medium">Recaudado</span>
                        <span class="text-2xl font-bold text-[#D2691E]"><?php echo number_format($total_recaudado, 0, ',', '.'); ?>€ <span class="text-white/50 text-sm font-normal">de <?php echo number_format($objetivo_donacion, 0, ',', '.'); ?>€</span></span>
                    </div>

                    <div class="w-full bg-white/10 rounded-full h-5 overflow-hidden">
                        <div class="bg-[#D2691E] h-full" style="width: <?php echo $porcentaje_objetivo; ?>%"></div>
                    </div>

                    <p class="text-sm mt-6 opacity-60 italic"><?php echo $restante_objetivo > 0 ? '¡Faltan ' . number_format($restante_objetivo, 0, ',', '.') . '€ para alcanzar el objetivo!' : '¡Objetivo alcanzado! Gracias por tu apoyo.'; ?></p>
                </div>
                <div class="absolute right-[-20px] top-1/2 -translate-y-1/2 text-white/5 text-[180px] pointer-events-none">
                    <i class="fa-solid fa-bullseye"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- NIVELES DE DONACIÓN -->
    <?php
        $nivel_bronce = 10;
        $nivel_plata = 50;
        $nivel_oro = 100;
        $total_donado_usuario = $total_donado_usuario ?? 0;
        $bronce_completado = $total_donado_usuario >= $nivel_bronce;
        $plata_completado = $total_donado_usuario >= $nivel_plata;
        $oro_completado = $total_donado_usuario >= $nivel_oro;
    ?>
    <section class="py-24 px-4 bg-[#f8f7f4] border-t border-gray-100">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-serif font-bold text-[#1a4d2e] text-center mb-4">Niveles de Donación</h2>
            <p class="text-center text-gray-500 mb-16 max-w-2xl mx-auto">Elige tu level de contribución y desbloquea recompensas exclusivas mientras ayudas a proteger al lince ibérico.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Bronce -->
                <div class="p-8 rounded-3xl shadow-sm text-center transition-transform duration-300 hover:scale-105 <?php echo $bronce_completado ? 'bg-emerald-50 border border-emerald-300 shadow-md' : 'bg-white border border-yellow-200'; ?>">
                    <div class="w-14 h-14 <?php echo $bronce_completado ? 'bg-emerald-100 text-emerald-700' : 'bg-orange-100 text-[#D2691E]'; ?> rounded-2xl flex items-center justify-center mx-auto mb-6 text-xl">
                        <i class="fa-solid fa-file-invoice"></i>
                    </div>
                    <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-2">Bronce</h3>
                    <div class="inline-block <?php echo $bronce_completado ? 'bg-emerald-600' : 'bg-[#D2691E]'; ?> text-white font-bold px-6 py-1 rounded-full text-xl mb-6">10€</div>
                    <p class="text-gray-500 text-sm mb-4">Perfecta para comenzar tu apoyo a la causa.</p>
                    <p class="text-sm font-semibold <?php echo $bronce_completado ? 'text-emerald-700' : 'text-gray-600'; ?> mb-6">
                        <?php echo $bronce_completado ? 'Nivel alcanzado' : 'Faltan ' . number_format(max(0, $nivel_bronce - $total_donado_usuario), 0, ',', '.') . '€'; ?>
                    </p>
                    <ul class="text-left space-y-4 text-sm text-gray-600">
                        <li class="flex items-center gap-3"><i class="fa-solid fa-file-contract text-orange-300"></i> Certificado digital personalizado</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-gift text-orange-300"></i> Pegatina exclusiva del lince</li>
                    </ul>
                </div>

                <!-- Plata -->
                <div class="p-8 rounded-3xl shadow-sm text-center transition-transform duration-300 hover:scale-105 <?php echo $plata_completado ? 'bg-emerald-50 border border-emerald-300 shadow-md' : 'bg-white border border-yellow-200'; ?>">
                    <div class="w-14 h-14 <?php echo $plata_completado ? 'bg-emerald-100 text-emerald-700' : 'bg-blue-50 text-blue-500'; ?> rounded-2xl flex items-center justify-center mx-auto mb-6 text-xl">
                        <i class="fa-solid fa-shirt"></i>
                    </div>
                    <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-2">Plata</h3>
                    <div class="inline-block <?php echo $plata_completado ? 'bg-emerald-600' : 'bg-slate-400'; ?> text-white font-bold px-6 py-1 rounded-full text-xl mb-6">50€</div>
                    <p class="text-gray-500 text-sm mb-4">Incluye todos los beneficios anteriores más una camiseta.</p>
                    <p class="text-sm font-semibold <?php echo $plata_completado ? 'text-emerald-700' : 'text-gray-600'; ?> mb-6">
                        <?php echo $plata_completado ? 'Nivel alcanzado' : 'Faltan ' . number_format(max(0, $nivel_plata - $total_donado_usuario), 0, ',', '.') . '€'; ?>
                    </p>
                    <ul class="text-left space-y-4 text-sm text-gray-600">
                        <li class="flex items-center gap-3"><i class="fa-solid fa-file-contract text-blue-200"></i> Certificado digital</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-gift text-blue-200"></i> Pegatina exclusiva</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-shirt text-blue-200"></i> Camiseta oficial de la ONG</li>
                    </ul>
                </div>

                <!-- Oro -->
                <div class="p-8 rounded-3xl shadow-sm text-center transition-transform duration-300 hover:scale-105 <?php echo $oro_completado ? 'bg-emerald-50 border border-emerald-300 shadow-md' : 'bg-white border border-yellow-200'; ?>">
                    <div class="w-14 h-14 <?php echo $oro_completado ? 'bg-emerald-100 text-emerald-700' : 'bg-yellow-50 text-yellow-600'; ?> rounded-2xl flex items-center justify-center mx-auto mb-6 text-xl">
                        <i class="fa-solid fa-binoculars"></i>
                    </div>
                    <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-2">Oro</h3>
                    <div class="inline-block <?php echo $oro_completado ? 'bg-emerald-600' : 'bg-yellow-500'; ?> text-white font-bold px-6 py-1 rounded-full text-xl mb-6">100€</div>
                    <p class="text-gray-500 text-sm mb-4">La experiencia completa incluyendo visita guiada.</p>
                    <p class="text-sm font-semibold <?php echo $oro_completado ? 'text-emerald-700' : 'text-gray-600'; ?> mb-6">
                        <?php echo $oro_completado ? 'Nivel alcanzado' : 'Faltan ' . number_format(max(0, $nivel_oro - $total_donado_usuario), 0, ',', '.') . '€'; ?>
                    </p>
                    <ul class="text-left space-y-4 text-sm text-gray-600">
                        <li class="flex items-center gap-3"><i class="fa-solid fa-file-contract text-yellow-300"></i> Todo lo anterior</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-map-location-dot text-yellow-300"></i> Visita guiada al centro</li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <!-- ¿CÓMO FUNCIONA? -->
    <section class="py-24 bg-[#f4f1ea] px-4">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-4xl font-serif font-bold text-[#1a4d2e] mb-20">¿Cómo funciona?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
                <div class="relative">
                    <div class="w-20 h-20 bg-[#D2691E] text-white rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-8 shadow-lg">1</div>
                    <h4 class="text-xl font-bold text-[#1a4d2e] mb-4">Elige tu nivel</h4>
                    <p class="text-gray-500 text-sm">Selecciona la cantidad con la que quieres contribuir.</p>
                </div>
                <div class="relative">
                    <div class="w-20 h-20 bg-[#D2691E] text-white rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-8 shadow-lg">2</div>
                    <h4 class="text-xl font-bold text-[#1a4d2e] mb-4">Realiza tu donación</h4>
                    <p class="text-gray-500 text-sm">Proceso seguro y rápido a través de nuestra plataforma.</p>
                </div>
                <div class="relative">
                    <div class="w-20 h-20 bg-[#D2691E] text-white rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-8 shadow-lg">3</div>
                    <h4 class="text-xl font-bold text-[#1a4d2e] mb-4">Recibe tus recompensas</h4>
                    <p class="text-gray-500 text-sm">Te enviaremos tus premios y te mantendremos informado.</p>
                </div>
            </div>
        </div>
    </section>

</main>

<?php 
/* INCLUIMOS EL FOOTER */
include '../Partes/footer.php'; 
?>