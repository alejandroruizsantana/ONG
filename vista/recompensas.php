<?php 
/* INCLUIMOS EL HEADER */
include '../Partes/header.php'; 
?>

<main class="flex-grow bg-[#f8f7f4]">

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

    <section class="pb-20 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="bg-[#1a4d2e] p-10 rounded-3xl shadow-2xl text-white relative overflow-hidden transition-transform duration-300 hover:scale-105">
                <div class="relative z-10">
                    <h3 class="text-3xl font-serif font-bold mb-2">Próximo objetivo</h3>
                    <p class="opacity-80 text-xl mb-10">Vallado térmico para zona de cría</p>

                    <div class="flex justify-between items-end mb-4">
                        <span class="text-sm font-medium">Recaudado</span>
                        <span class="text-2xl font-bold text-[#D2691E]">0€ <span class="text-white/50 text-sm font-normal">de 5000€</span></span>
                    </div>

                    <div class="w-full bg-white/10 rounded-full h-5 overflow-hidden">
                        <div class="bg-[#D2691E] h-full w-0 transition-all duration-1000"></div>
                    </div>

                    <p class="text-sm mt-6 opacity-60 italic">¡Faltan 5000€ para alcanzar el objetivo!</p>
                </div>
                <div class="absolute right-[-20px] top-1/2 -translate-y-1/2 text-white/5 text-[180px] pointer-events-none">
                    <i class="fa-solid fa-bullseye"></i>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white px-4 border-y border-gray-100">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-serif font-bold text-[#1a4d2e] text-center mb-16">Logros de la comunidad</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-[#1a4d2e] p-10 rounded-3xl border-2 border-[#D2691E]/30 text-center shadow-lg transition-transform duration-300 hover:scale-105">
                    <div class="w-16 h-16 bg-[#D2691E]/20 text-[#D2691E] rounded-2xl flex items-center justify-center mx-auto mb-6 text-2xl border border-[#D2691E]/20">
                        <i class="fa-solid fa-trophy"></i>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-2 font-serif">500kg recogidos</h4>
                    <p class="text-orange-200/60 text-sm italic font-medium">Pendiente de alcanzar</p>
                </div>

                <div class="bg-[#1a4d2e] p-10 rounded-3xl border-2 border-[#D2691E]/30 text-center shadow-lg transition-transform duration-300 hover:scale-105">
                    <div class="w-16 h-16 bg-[#D2691E]/20 text-[#D2691E] rounded-2xl flex items-center justify-center mx-auto mb-6 text-2xl border border-[#D2691E]/20">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-2 font-serif">100 voluntarios</h4>
                    <p class="text-orange-200/60 text-sm italic font-medium">Pendiente de alcanzar</p>
                </div>

                <div class="bg-[#1a4d2e] p-10 rounded-3xl border-2 border-[#D2691E]/30 text-center shadow-lg transition-transform duration-300 hover:scale-105">
                    <div class="w-16 h-16 bg-[#D2691E]/20 text-[#D2691E] rounded-2xl flex items-center justify-center mx-auto mb-6 text-2xl border border-[#D2691E]/20">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-2 font-serif">10 quedadas</h4>
                    <p class="text-orange-200/60 text-sm italic font-medium">Pendiente de alcanzar</p>
                </div>

                <div class="bg-[#1a4d2e] p-10 rounded-3xl border-2 border-[#D2691E]/30 text-center shadow-lg transition-transform duration-300 hover:scale-105">
                    <div class="w-16 h-16 bg-[#D2691E]/20 text-[#D2691E] rounded-2xl flex items-center justify-center mx-auto mb-6 text-2xl border border-[#D2691E]/20">
                        <i class="fa-solid fa-euro-sign"></i>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-2 font-serif">5.000€ vallado</h4>
                    <p class="text-orange-200/60 text-sm italic font-medium">Pendiente de alcanzar</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 px-4 bg-[#f8f7f4]">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-serif font-bold text-[#1a4d2e] text-center mb-4">Niveles de Donación</h2>
            <p class="text-center text-gray-500 mb-16 max-w-2xl mx-auto">Elige tu nivel de contribución y desbloquea recompensas exclusivas mientras ayudas a proteger al lince ibérico.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-3xl border border-yellow-200 shadow-sm text-center transition-transform duration-300 hover:scale-105">
                    <div class="w-14 h-14 bg-orange-100 text-[#D2691E] rounded-2xl flex items-center justify-center mx-auto mb-6 text-xl ">
                        <i class="fa-solid fa-file-invoice"></i>
                    </div>
                    <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-2">Bronce</h3>
                    <div class="inline-block bg-[#D2691E] text-white font-bold px-6 py-1 rounded-full text-xl mb-6">10€</div>
                    <p class="text-gray-500 text-sm mb-8">Perfecta para comenzar tu apoyo a la causa.</p>
                    <ul class="text-left space-y-4 text-sm text-gray-600">
                        <li class="flex items-center gap-3"><i class="fa-solid fa-file-contract text-orange-300"></i> Certificado digital personalizado</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-gift text-orange-300"></i> Pegatina exclusiva del lince</li>
                    </ul>
                </div>

                <div class="bg-white p-8 rounded-3xl border border-yellow-200 shadow-sm text-center relative transition-transform duration-300 hover:scale-105">
                   
                    <div class="w-14 h-14 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-6 text-xl">
                        <i class="fa-solid fa-shirt"></i>
                    </div>
                    <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-2">Plata</h3>
                    <div class="inline-block bg-slate-400 text-white font-bold px-6 py-1 rounded-full text-xl mb-6">50€</div>
                    <p class="text-gray-500 text-sm mb-8">Incluye todos los beneficios anteriores más una camiseta.</p>
                    <ul class="text-left space-y-4 text-sm text-gray-600">
                        <li class="flex items-center gap-3"><i class="fa-solid fa-file-contract text-blue-200"></i> Certificado digital</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-gift text-blue-200"></i> Pegatina exclusiva</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-shirt text-blue-200"></i> Camiseta oficial de la ONG</li>
                    </ul>
                </div>

                <div class="bg-white p-8 rounded-3xl border border-yellow-200 shadow-sm text-center transition-transform duration-300 hover:scale-105">
                    <div class="w-14 h-14 bg-yellow-50 text-yellow-600 rounded-2xl flex items-center justify-center mx-auto mb-6 text-xl">
                        <i class="fa-solid fa-binoculars"></i>
                    </div>
                    <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-2">Oro</h3>
                    <div class="inline-block bg-yellow-500 text-white font-bold px-6 py-1 rounded-full text-xl mb-6">100€</div>
                    <p class="text-gray-500 text-sm mb-8">La experiencia completa incluyendo visita guiada.</p>
                    <ul class="text-left space-y-4 text-sm text-gray-600">
                        <li class="flex items-center gap-3"><i class="fa-solid fa-file-contract text-yellow-300"></i> Todo lo anterior</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-map-location-dot text-yellow-300"></i> Visita guiada al centro</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

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