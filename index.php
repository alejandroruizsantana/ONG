<?php
/* INCLUIMOS EL HEADER */
include 'partes/header.php';
?>

<!-- SECCION PORTADA -->
<section class="relative w-full h-[800px] flex items-center justify-center overflow-hidden">
    
    <!-- IMAGEN DE FONDO -->
    <img src="../assets/imagenes/lince_inicio1.jpg" 
         alt="Lince Ibérico" 
         class="absolute inset-0 w-full h-full object-cover">

    <!-- CAPA VERDE PARA LA IMAGEN -->
    <div class="absolute inset-0 bg-[#1a4d2e]/60 "></div>

    <!-- CONTENIDO PRINCIPAL -->
    <div class="relative z-10 text-center px-4 max-w-3xl">
        
        <!-- TITULO PRINCIPAL -->
        <h2 class="text-4xl md:text-6xl font-serif font-bold text-white mb-6 leading-tight">
            Protegemos el <span class="text-[#D2691E]">Latido</span> del Bosque
        </h2>

        <!-- TEXTO DESCRIPTIVO -->
        <p class="text-white/90 text-lg md:text-xl mb-10 leading-relaxed">
            Únete a nuestra misión de conservar al lince ibérico y restaurar su hábitat natural. 
            Cada acción cuenta para asegurar el futuro de nuestra fauna más emblemática.
        </p>

        <!-- BOTONES -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            
            <!-- BOTON DONACIONES -->
            <a href="donaciones.php" class="bg-[#D2691E] text-white px-8 py-4 rounded-xl font-bold text-lg hover:scale-105 transition-transform flex items-center justify-center gap-2 shadow-xl">
                <span>&#9825;</span> Hacer una donación
            </a>

            <!-- BOTON QUEDADAS -->
            <a href="quedada.php" 
               class="group flex items-center justify-between bg-[#f8f9f4] text-[#1a4d2e] px-6 py-4 rounded-2xl font-semibold text-lg w-full sm:w-72 shadow-md hover:bg-white transition-all">
    
                <div class="flex items-center gap-3">
                    <span>Ver quedadas</span>
                </div>

                <i class="fa-solid fa-arrow-right transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>
    </div>
</section>

<!-- SECCION MISIONES -->
<section class="bg-[#f8f7f4] py-20 px-4">
    <div class="max-w-6xl mx-auto">
        
        <!-- ENCABEZADO -->
        <div class="text-center mb-16">
            <span class="bg-gray-200 text-[#1a4d2e] text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-wider">
                Nuestra Misión
            </span>
            <h2 class="text-4xl font-serif font-bold text-[#1a4d2e] mt-6 mb-4">
                ¿Qué hacemos por el Lince?
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto leading-relaxed ">
                Combinamos acción directa, educación y ciencia para asegurar la supervivencia del lince ibérico.
            </p>
        </div>

        <!-- TARJETAS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <!-- TARJETA CONSERVACION -->
            <div class="bg-white p-10 rounded-3xl shadow-sm hover:shadow-xl transition-shadow text-center flex flex-col items-center">
                <div class="w-16 h-16 bg-[#D2691E] rounded-2xl flex items-center justify-center text-white text-3xl mb-6 shadow-lg shadow-orange-200">
                    <i class="fa-solid fa-heart"></i>
                </div>
                <h3 class="text-xl font-bold text-[#1a4d2e] mb-4 font-serif">Conservación Activa</h3>
                <p class="text-gray-500 leading-relaxed">   
                    Trabajamos directamente en el terreno para proteger y monitorear a los linces en su hábitat natural.
                </p>
            </div>

            <!-- TARJETA LIMPIEZA -->
            <div class="bg-white p-10 rounded-3xl shadow-sm hover:shadow-xl transition-shadow text-center flex flex-col items-center">
                <div class="w-16 h-16 bg-[#D2691E] rounded-2xl flex items-center justify-center text-white text-3xl mb-6 shadow-lg shadow-orange-200">
                    <i class="fa-solid fa-tree"></i>
                </div>
                <h3 class="text-xl font-bold text-[#1a4d2e] mb-4 font-serif">Limpieza del Hábitat</h3>
                <p class="text-gray-500 leading-relaxed">
                    Organizamos jornadas de limpieza para eliminar residuos que amenazan el ecosistema del lince.
                </p>
            </div>

            <!-- TARJETA COMUNIDAD -->
            <div class="bg-white p-10 rounded-3xl shadow-sm hover:shadow-xl transition-shadow text-center flex flex-col items-center">
                <div class="w-16 h-16 bg-[#D2691E] rounded-2xl flex items-center justify-center text-white text-3xl mb-6 shadow-lg shadow-orange-200">
                    <i class="fa-solid fa-users"></i>
                </div>
                <h3 class="text-xl font-bold text-[#1a4d2e] mb-4 font-serif">Comunidad Unida</h3>
                <p class="text-gray-500 leading-relaxed">
                    Miles de voluntarios comprometidos con la causa, formando una red de protección activa.
                </p>
            </div>

            <!-- TARJETA EDUCACION -->
            <div class="bg-white p-10 rounded-3xl shadow-sm hover:shadow-xl transition-shadow text-center flex flex-col items-center">
                <div class="w-16 h-16 bg-[#D2691E] rounded-2xl flex items-center justify-center text-white text-3xl mb-6 shadow-lg shadow-orange-200">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h3 class="text-xl font-bold text-[#1a4d2e] mb-4 font-serif">Educación Ambiental</h3>
                <p class="text-gray-500 leading-relaxed">
                    Sensibilizamos a las nuevas generaciones sobre la importancia de conservar nuestra fauna.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- SECCION NOTICIAS -->
<section class="bg-[#f4f1ea] py-20 px-4">
    <div class="max-w-6xl mx-auto">
        
        <!-- ENCABEZADO -->
        <div class="text-center mb-16">
            <span class="bg-gray-200 text-[#1a4d2e] text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-wider">
                Últimas noticias
            </span>
            <h2 class="text-4xl font-serif font-bold text-[#1a4d2e] mt-6 mb-4">
                Novedades del Lince
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Mantente informado sobre nuestras actividades y los avances en la conservación del lince ibérico.
            </p>
        </div>

        <!-- LISTADO DE NOTICIAS -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
            
            <!-- NOTICIA 1 -->
            <article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all group">
                <div class="relative h-56 overflow-hidden">
                    <img src="../assets/imagenes/cachorros_inicio.jpg" alt="Cachorros" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <span class="absolute top-4 left-4 bg-[#D2691E] text-white text-xs font-bold px-3 py-1 rounded-full">
                        Conservación
                    </span>
                </div>
                <div class="p-8">
                    <div class="flex items-center gap-4 text-gray-400 text-xs mb-4">
                        <span class="flex items-center gap-1"><i class="fa-regular fa-calendar"></i> 15 Enero 2024</span>
                        <span class="flex items-center gap-1"><i class="fa-solid fa-location-dot"></i> Doñana, Huelva</span>
                    </div>
                    <h3 class="text-xl font-bold text-[#1a4d2e] mb-4 font-serif leading-snug">
                        Nuevo nacimiento de cachorros en Doñana
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">
                        Celebramos la llegada de una nueva camada que refuerza la población en el área protegida.
                    </p>
                    <a href="#" class="text-[#1a4d2e] font-bold text-sm flex items-center gap-2 hover:gap-3 transition-all">
                        Leer más <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </article>

            <!-- NOTICIA 2 -->
            <article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all group">
                <div class="relative h-56 overflow-hidden">
                    <img src="../assets/imagenes/sierradeandujar.jpg" alt="Hábitat" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <span class="absolute top-4 left-4 bg-[#D2691E] text-white text-xs font-bold px-3 py-1 rounded-full">
                        Actividades
                    </span>
                </div>
                <div class="p-8">
                    <div class="flex items-center gap-4 text-gray-400 text-xs mb-4">
                        <span class="flex items-center gap-1"><i class="fa-regular fa-calendar"></i> 10 Enero 2024</span>
                        <span class="flex items-center gap-1"><i class="fa-solid fa-location-dot"></i> Sierra de Andújar</span>
                    </div>
                    <h3 class="text-xl font-bold text-[#1a4d2e] mb-4 font-serif leading-snug">
                        Jornada de reforestación masiva
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">
                        Más de 100 voluntarios plantaron especies autóctonas para mejorar el hábitat del lince.
                    </p>
                    <a href="#" class="text-[#1a4d2e] font-bold text-sm flex items-center gap-2 hover:gap-3 transition-all">
                        Leer más <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </article>

            <!-- NOTICIA 3 -->
            <article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all group">
                <div class="relative h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&q=80" alt="Educación" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <span class="absolute top-4 left-4 bg-[#D2691E] text-white text-xs font-bold px-3 py-1 rounded-full">
                        Educación
                    </span>
                </div>
                <div class="p-8">
                    <div class="flex items-center gap-4 text-gray-400 text-xs mb-4">
                        <span class="flex items-center gap-1"><i class="fa-regular fa-calendar"></i> 5 Enero 2024</span>
                        <span class="flex items-center gap-1"><i class="fa-solid fa-location-dot"></i> Andalucía</span>
                    </div>
                    <h3 class="text-xl font-bold text-[#1a4d2e] mb-4 font-serif leading-snug">
                        Programa de educación ambiental en colegios
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">
                        Lanzamos un nuevo programa educativo para sensibilizar a los más jóvenes sobre el lince.
                    </p>
                    <a href="#" class="text-[#1a4d2e] font-bold text-sm flex items-center gap-2 hover:gap-3 transition-all">
                        Leer más <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </article>

        </div>
    </div>
</section>

<?php
/* INCLUIMOS EL FOOTER */
include 'partes/footer.php';
?>
