<?php
/* INCLUIMOS EL HEADER */
include 'partes/header.php';
?>

<!-- sección hero: imagen de fondo con el lince y llamada a la acción principal -->
<section class="relative w-full h-[800px] flex items-center justify-center overflow-hidden">
    <img src="../assets/imagenes/lince_inicio1.jpg" 
         alt="Lince Ibérico" 
         class="absolute inset-0 w-full h-full object-cover">

    <!-- capa oscura verde sobre la imagen para mejorar la legibilidad del texto -->
    <div class="absolute inset-0 bg-[#1a4d2e]/60 "></div>

    <div class="relative z-10 text-center px-4 max-w-3xl">
        <h2 class="text-4xl md:text-6xl font-serif font-bold text-white mb-6 leading-tight">
            Protegemos el <span class="text-[#D2691E]">Latido</span> del Bosque
        </h2>
        <p class="text-white/90 text-lg md:text-xl mb-10 leading-relaxed">
            Únete a nuestra misión de conservar al lince ibérico y restaurar su hábitat natural. 
            Cada acción cuenta para asegurar el futuro de nuestra fauna más emblemática.
        </p>

        <!-- botones de acción: donación y ver quedadas -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="../vista/donaciones.php" class="bg-[#D2691E] text-white px-8 py-4 rounded-xl font-bold text-lg hover:scale-105 transition-transform flex items-center justify-center gap-2 shadow-xl">
                <span>&#9825;</span> Hacer una donación
            </a>

            <a href="../vista/quedadas.php" 
               class="group flex items-center justify-between bg-[#f8f9f4] text-[#1a4d2e] px-6 py-4 rounded-2xl font-semibold text-lg w-full sm:w-72 shadow-md hover:bg-white transition-all">
                <div class="flex items-center gap-3">
                    <span>Ver quedadas</span>
                </div>
                <i class="fa-solid fa-arrow-right transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>
    </div>
</section>

<!-- sección de misión: cuatro pilares de actuación de la ong -->
<section class="bg-[#f8f7f4] py-20 px-4">
    <div class="max-w-6xl mx-auto">
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

        <!-- grid de tarjetas con los cuatro pilares -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- tarjeta: conservación activa -->
            <div class="bg-white p-10 rounded-3xl shadow-sm hover:shadow-xl transition-shadow text-center flex flex-col items-center">
                <div class="w-16 h-16 bg-[#D2691E] rounded-2xl flex items-center justify-center text-white text-3xl mb-6 shadow-lg shadow-orange-200">
                    <i class="fa-solid fa-heart"></i>
                </div>
                <h3 class="text-xl font-bold text-[#1a4d2e] mb-4 font-serif">Conservación Activa</h3>
                <p class="text-gray-500 leading-relaxed">   
                    Trabajamos directamente en el terreno para proteger y monitorear a los linces en su hábitat natural.
                </p>
            </div>

            <!-- tarjeta: limpieza del hábitat -->
            <div class="bg-white p-10 rounded-3xl shadow-sm hover:shadow-xl transition-shadow text-center flex flex-col items-center">
                <div class="w-16 h-16 bg-[#D2691E] rounded-2xl flex items-center justify-center text-white text-3xl mb-6 shadow-lg shadow-orange-200">
                    <i class="fa-solid fa-tree"></i>
                </div>
                <h3 class="text-xl font-bold text-[#1a4d2e] mb-4 font-serif">Limpieza del Hábitat</h3>
                <p class="text-gray-500 leading-relaxed">
                    Organizamos jornadas de limpieza para eliminar residuos que amenazan el ecosistema del lince.
                </p>
            </div>

            <!-- tarjeta: comunidad unida -->
            <div class="bg-white p-10 rounded-3xl shadow-sm hover:shadow-xl transition-shadow text-center flex flex-col items-center">
                <div class="w-16 h-16 bg-[#D2691E] rounded-2xl flex items-center justify-center text-white text-3xl mb-6 shadow-lg shadow-orange-200">
                    <i class="fa-solid fa-users"></i>
                </div>
                <h3 class="text-xl font-bold text-[#1a4d2e] mb-4 font-serif">Comunidad Unida</h3>
                <p class="text-gray-500 leading-relaxed">
                    Miles de voluntarios comprometidos con la causa, forming una red de protección activa.
                </p>
            </div>

            <!-- tarjeta: educación ambiental -->
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

<!-- sección de logros: tres artículos con impacto real conseguido -->
<section class="bg-[#f4f1ea] py-20 px-4">
    <div class="max-w-6xl mx-auto">
        
        <div class="text-center mb-16">
            <span class="bg-gray-200 text-[#1a4d2e] text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-wider">
                Logros conseguidos
            </span>
            <h2 class="text-4xl font-serif font-bold text-[#1a4d2e] mt-6 mb-4">
                Nuestro Impacto Real
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Gracias al apoyo de los donantes y al esfuerzo de los voluntarios en las quedadas, alcanzamos metas vitales.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- artículo 1: consolidación población -->
            <article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all group">
                <div class="relative h-56 overflow-hidden">
                    <img src="../assets/imagenes/cachorros_inicio.jpg" alt="Recuperación" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <span class="absolute top-4 left-4 bg-[#1a4d2e] text-white text-xs font-bold px-3 py-1 rounded-full">
                        Población
                    </span>
                </div>
                <div class="p-8">
                    <h3 class="text-xl font-bold text-[#1a4d2e] mb-3 font-serif leading-snug">
                        Consolidación en Sierra Morena
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">
                        Superamos el umbral crítico de ejemplares censados en la zona, garantizando una mayor variabilidad genética de la especie.
                    </p>
                </div>
            </article>

            <!-- artículo 2: limpieza de territorio -->
            <article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all group">
                <div class="relative h-56 overflow-hidden">
                    <img src="../assets/imagenes/sierradeandujar.jpg" alt="Espacio Seguro" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <span class="absolute top-4 left-4 bg-[#1a4d2e] text-white text-xs font-bold px-3 py-1 rounded-full">
                        Territorio
                    </span>
                </div>
                <div class="p-8">
                    <h3 class="text-xl font-bold text-[#1a4d2e] mb-3 font-serif leading-snug">
                        Hectáreas Libres de Residuos
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">
                        A través de las quedadas de limpieza masivas, hemos descontaminado de plástico corredores ecológicos clave para los linces.
                    </p>
                </div>
            </article>

            <!-- artículo 3: concienciación social (imagen externa de unsplash) -->
            <article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all group">
                <div class="relative h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&q=80" alt="Concienciación" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <span class="absolute top-4 left-4 bg-[#1a4d2e] text-white text-xs font-bold px-3 py-1 rounded-full">
                        Sociedad
                    </span>
                </div>
                <div class="p-8">
                    <h3 class="text-xl font-bold text-[#1a4d2e] mb-3 font-serif leading-snug">
                        Concienciación Rural Activa
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">
                        Logramos acuerdos de colaboración con fincas agrícolas colindantes para asegurar pasos seguros y balsas de agua adaptadas.
                    </p>
                </div>
            </article>

        </div>
    </div>
</section>

<!-- sección de llamada a la acción: cómo colaborar con la ong -->
<section class="bg-white py-20 px-4">
    <div class="max-w-6xl mx-auto">
        
        <div class="text-center mb-16">
            <span class="bg-amber-100 text-amber-800 text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-wider">
                ¡Pasa a la acción!
            </span>
            <h2 class="text-4xl font-serif font-bold text-[#1a4d2e] mt-6 mb-4">
                ¿Cómo puedes colaborar?
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto leading-relaxed">
                No importa tu disponibilidad o recursos, existen diferentes maneras de arrimar el hombro por la causa.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            
            <!-- tarjeta: apuntarse a una quedada -->
            <div class="bg-[#f8f7f4] p-8 rounded-3xl border border-gray-100 flex flex-col justify-between items-start transition-all hover:shadow-md">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-[#1a4d2e] text-white flex items-center justify-center text-xl mb-6">
                        <i class="fa-solid fa-person-hiking"></i>
                    </div>
                    <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-3">Apúntate a una Quedada</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">
                        Ven al terreno con nosotros. Limpiamos zonas críticas de vertidos, reforestamos bosques mediterráneos y adecuamos espacios para el lince.
                    </p>
                </div>
                <a href="../vista/quedadas.php" class="inline-flex items-center gap-2 bg-[#1a4d2e] text-white font-bold px-5 py-3 rounded-xl text-sm hover:bg-[#143d24] transition-colors">
                    Ver próximos eventos <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            <!-- tarjeta: realizar una donación -->
            <div class="bg-[#f8f7f4] p-8 rounded-3xl border border-gray-100 flex flex-col justify-between items-start transition-all hover:shadow-md">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-[#D2691E] text-white flex items-center justify-center text-xl mb-6">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                    </div>
                    <h3 class="text-2xl font-serif font-bold text-[#1a4d2e] mb-3">Realiza una Donación</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">
                        Financia de manera directa el vallado térmico de las zonas de cría, los proyectos de monitorización científica y la compra de suministros médicos.
                    </p>
                </div>
                <a href="../vista/donaciones.php" class="inline-flex items-center gap-2 bg-[#D2691E] text-white font-bold px-5 py-3 rounded-xl text-sm hover:bg-[#b85c1a] transition-colors">
                    Donar ahora <i class="fa-solid fa-heart text-xs"></i>
                </a>
            </div>

        </div>
    </div>
</section>

<?php
/* INCLUIMOS EL FOOTER */
include 'partes/footer.php';
?>