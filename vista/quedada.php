<?php 
/* INCLUIMOS EL HEADER */
include '../Partes/header.php'; 
?>

<main class="flex-grow bg-[#f8f7f4]">

    <section class="bg-[#1a4d2e] pt-32 pb-20 px-4 text-center text-white">
        <div class="max-w-4xl mx-auto">
            <span class="bg-[#D2691E] text-white text-xs font-bold px-4 py-1.5 rounded-full uppercase mb-6 inline-block">
                Participa
            </span>
            <h1 class="text-5xl md:text-7xl font-serif font-bold mb-6">
                Quedadas de <span class="text-[#D2691E]">Limpieza</span>
            </h1>
            <p class="text-gray-200 text-lg md:text-xl max-w-3xl mx-auto mb-16">
                Únete a nuestros voluntarios y ayuda a mantener limpio el hábitat del lince ibérico. ¡Cada mano cuenta!
            </p>

            <div class="grid grid-cols-1  md:grid-cols-3 gap-8 pt-10 border-t border-white/10">
                <div>
                    <span class="block text-4xl font-bold text-white">50+</span>
                    <span class="text-sm uppercase tracking-wider text-gray-300">Eventos realizados</span>
                </div>
                <div>
                    <span class="block text-4xl font-bold text-[#D2691E]">15 ton</span>
                    <span class="text-sm uppercase tracking-wider text-gray-300">Residuos recogidos</span>
                </div>
                <div>
                    <span class="block text-4xl font-bold text-white">5000+</span>
                    <span class="text-sm uppercase tracking-wider text-gray-300">Voluntarios</span>
                </div>
            </div>
        </div>
    </section>

    <section class=" py-1 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-[#1a4d2e] mb-4">Próximos Eventos</h2>
                <p class="text-gray-500">Elige la quedada que mejor te venga y reserva tu plaza. ¡Las plazas son limitadas!</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                    <div class="relative h-64 overflow-hidden">
                        <img src="../assets/imagenes/Andujar.jpg" alt="Sierra de Andújar" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-gray-700 flex items-center gap-1">
                            <i class="fa-solid fa-users text-[#D2691E]"></i> 45/60
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-4">Limpieza Sierra de Andújar</h3>
                        <div class="space-y-3 mb-6 text-sm text-gray-500">
                            <div class="flex items-center gap-3"><i class="fa-regular fa-calendar text-[#D2691E]"></i> 27 Enero 2024</div>
                            <div class="flex items-center gap-3"><i class="fa-regular fa-clock text-[#D2691E]"></i> 09:00 - 14:00</div>
                            <div class="flex items-center gap-3"><i class="fa-solid fa-location-dot text-[#D2691E]"></i> Sierra de Andújar, Jaén</div>
                        </div>
                        <p class="text-gray-600 text-sm mb-6 line-clamp-2">Jornada de limpieza en el corazón del hábitat del lince. Retiraremos residuos de senderos y arroyos.</p>
                        
                        <div class="mb-6">
                            <div class="flex justify-between text-xs mb-2">
                                <span class="text-gray-400 font-medium">Plazas ocupadas</span>
                                <span class="text-gray-400">75%</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div class="bg-[#D2691E] h-full rounded-full" style="width: 75%"></div>
                            </div>
                        </div>

                        <a href="#" class="block w-full py-4 bg-[#D2691E] hover:bg-[#b85c1a] text-white text-center rounded-xl font-bold transition-colors">
                            Apuntarme <i class="fa-solid fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                    <div class="relative h-64 overflow-hidden">
                        <img src="../assets/imagenes/Doñana.jpg" alt="Doñana" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-gray-700 flex items-center gap-1">
                            <i class="fa-solid fa-users text-[#D2691E]"></i> 32/50
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-4">Reforestación Doñana</h3>
                        <div class="space-y-3 mb-6 text-sm text-gray-500">
                            <div class="flex items-center gap-3"><i class="fa-regular fa-calendar text-[#D2691E]"></i> 10 Febrero 2024</div>
                            <div class="flex items-center gap-3"><i class="fa-regular fa-clock text-[#D2691E]"></i> 08:30 - 13:00</div>
                            <div class="flex items-center gap-3"><i class="fa-solid fa-location-dot text-[#D2691E]"></i> Parque Nacional de Doñana</div>
                        </div>
                        <p class="text-gray-600 text-sm mb-6 line-clamp-2">Plantaremos especies autóctonas para ampliar las zonas de refugio del lince ibérico.</p>
                        
                        <div class="mb-6">
                            <div class="flex justify-between text-xs mb-2">
                                <span class="text-gray-400 font-medium">Plazas ocupadas</span>
                                <span class="text-gray-400">64%</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div class="bg-[#D2691E] h-full rounded-full" style="width: 64%"></div>
                            </div>
                        </div>

                        <a href="#" class="block w-full py-4 bg-[#D2691E] hover:bg-[#b85c1a] text-white text-center rounded-xl font-bold transition-colors">
                            Apuntarme <i class="fa-solid fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                    <div class="relative h-64 overflow-hidden">
                        <img src="../assets/imagenes/Sierra_morena.jpg" alt="Sierra Morena" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-gray-700 flex items-center gap-1">
                            <i class="fa-solid fa-users text-[#D2691E]"></i> 28/40
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-4">Limpieza Sierra Morena</h3>
                        <div class="space-y-3 mb-6 text-sm text-gray-500">
                            <div class="flex items-center gap-3"><i class="fa-regular fa-calendar text-[#D2691E]"></i> 24 Febrero 2024</div>
                            <div class="flex items-center gap-3"><i class="fa-regular fa-clock text-[#D2691E]"></i> 09:00 - 14:00</div>
                            <div class="flex items-center gap-3"><i class="fa-solid fa-location-dot text-[#D2691E]"></i> Sierra Morena, Córdoba</div>
                        </div>
                        <p class="text-gray-600 text-sm mb-6 line-clamp-2">Retiraremos plásticos y residuos de las riberas que atraviesan el territorio lincero.</p>
                        
                        <div class="mb-6">
                            <div class="flex justify-between text-xs mb-2">
                                <span class="text-gray-400 font-medium">Plazas ocupadas</span>
                                <span class="text-gray-400">70%</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div class="bg-[#D2691E] h-full rounded-full" style="width: 70%"></div>
                            </div>
                        </div>

                        <a href="#" class="block w-full py-4 bg-[#D2691E] hover:bg-[#b85c1a] text-white text-center rounded-xl font-bold transition-colors">
                            Apuntarme <i class="fa-solid fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                

            </div>
        </div>
    </section>

    <section class="py-24 px-4">
       

            <div class="grid max-w-7xl mx-auto grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                    <div class="relative h-64 overflow-hidden">
                        <img src="../assets/imagenes/toledo.jpg" alt="Montes de toledo" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-gray-700 flex items-center gap-1">
                            <i class="fa-solid fa-users text-[#D2691E]"></i> 45/60
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-4">Jornada Familiar Montes de Toledo</h3>
                        <div class="space-y-3 mb-6 text-sm text-gray-500">
                            <div class="flex items-center gap-3"><i class="fa-regular fa-calendar text-[#D2691E]"></i> 9 Marzo 2024</div>
                            <div class="flex items-center gap-3"><i class="fa-regular fa-clock text-[#D2691E]"></i> 10:00 - 14:00</div>
                            <div class="flex items-center gap-3"><i class="fa-solid fa-location-dot text-[#D2691E]"></i> Montes de Toledo, Toledo</div>
                        </div>
                        <p class="text-gray-600 text-sm mb-6 line-clamp-2">Actividad para toda la familia con talleres educativos sobre el lince y limpieza de senderos.</p>
                        
                        <div class="mb-6">
                            <div class="flex justify-between text-xs mb-2">
                                <span class="text-gray-400 font-medium">Plazas ocupadas</span>
                                <span class="text-gray-400">75%</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div class="bg-[#D2691E] h-full rounded-full" style="width: 75%"></div>
                            </div>
                        </div>

                        <a href="#" class="block w-full py-4 bg-[#D2691E] hover:bg-[#b85c1a] text-white text-center rounded-xl font-bold transition-colors">
                            Apuntarme <i class="fa-solid fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                    <div class="relative h-64 overflow-hidden">
                        <img src="../assets/imagenes/extremadura.jpg" alt="Monfragüe_Cáceres " class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-gray-700 flex items-center gap-1">
                            <i class="fa-solid fa-users text-[#D2691E]"></i> 32/50
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-4">Limpieza Nocturna Extremadura</h3>
                        <div class="space-y-3 mb-6 text-sm text-gray-500">
                            <div class="flex items-center gap-3"><i class="fa-regular fa-calendar text-[#D2691E]"></i>23 Marzo 2024</div>
                            <div class="flex items-center gap-3"><i class="fa-regular fa-clock text-[#D2691E]"></i> 18:00 - 22:00</div>
                            <div class="flex items-center gap-3"><i class="fa-solid fa-location-dot text-[#D2691E]"></i>Monfragüe, Cáceres </div>
                        </div>
                        <p class="text-gray-600 text-sm mb-6 line-clamp-2">Experiencia única: limpieza al atardecer con posibilidad de avistamiento de fauna.</p>
                        
                        <div class="mb-6">
                            <div class="flex justify-between text-xs mb-2">
                                <span class="text-gray-400 font-medium">Plazas ocupadas</span>
                                <span class="text-gray-400">64%</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div class="bg-[#D2691E] h-full rounded-full" style="width: 64%"></div>
                            </div>
                        </div>

                        <a href="#" class="block w-full py-4 bg-[#D2691E] hover:bg-[#b85c1a] text-white text-center rounded-xl font-bold transition-colors">
                            Apuntarme <i class="fa-solid fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                    <div class="relative h-64 overflow-hidden">
                        <img src="../assets/imagenes/portugal.jpg" alt="Vale do Guadiana" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-gray-700 flex items-center gap-1">
                            <i class="fa-solid fa-users text-[#D2691E]"></i> 28/40
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-4">Maratón de Limpieza Portugal</h3>
                        <div class="space-y-3 mb-6 text-sm text-gray-500">
                            <div class="flex items-center gap-3"><i class="fa-regular fa-calendar text-[#D2691E]"></i> 6 Abril 2024</div>
                            <div class="flex items-center gap-3"><i class="fa-regular fa-clock text-[#D2691E]"></i> 08:00 - 18:00</div>
                            <div class="flex items-center gap-3"><i class="fa-solid fa-location-dot text-[#D2691E]"></i> Vale do Guadiana, Portugal</div>
                        </div>
                        <p class="text-gray-600 text-sm mb-6 line-clamp-2">Gran evento transfronterizo para limpiar el corredor ecológico España-Portugal</p>
                        
                        <div class="mb-6">
                            <div class="flex justify-between text-xs mb-2">
                                <span class="text-gray-400 font-medium">Plazas ocupadas</span>
                                <span class="text-gray-400">70%</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div class="bg-[#D2691E] h-full rounded-full" style="width: 70%"></div>
                            </div>
                        </div>

                        <a href="#" class="block w-full py-4 bg-[#D2691E] hover:bg-[#b85c1a] text-white text-center rounded-xl font-bold transition-colors">
                            Apuntarme <i class="fa-solid fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                

            </div>
        </div>
    </section>

    
   
</main>

<?php 
/* INCLUIMOS EL FOOTER */
include '../Partes/footer.php'; 
?>