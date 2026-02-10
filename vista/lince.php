<?php
/* INCLUIMOS EL HEADER */
include '../partes/header.php';
?>

<main class="flex-grow pt-20">

    <section class="bg-[#f4f1ea]  py-20 px-4 text-center">
        <div class="max-w-4xl mx-auto">
            
            <span class="inline-block bg-[#D2691E] text-white text-xs font-bold px-4 py-1.5 rounded-full uppercase mb-6">
                Conoce a nuestra especie
            </span>

            <h1 class="text-5xl  md:text-7xl font-serif  text-[#1a4d2e] mb-6 ">
                El <span class="text-[#D2691E] font-bold">Lince Ibérico</span>
            </h1>

            <p class="text-[#1a4d2e] text-lg md:text-xl leading-relaxed opacity-90">
                El felino más amenazado del mundo y el símbolo de la conservación en la Península Ibérica.
            </p>

        </div>
    </section>

    <section class="py-20 px-4 bg-white">
    <div class="max-w-4xl mx-auto">
        
        <span class="bg-gray-100 text-gray-600 text-xs font-bold px-4 py-1.5 rounded-full uppercase  mb-6 inline-block">
            Biología
        </span>

        <h2 class="text-4xl md:text-5xl font-serif font-bold text-[#1a4d2e] mb-10 ">
            Una especie única en el mundo
        </h2>

        <div class="space-y-6 text-gray-600 text-lg ">
            <p>
                El <span class="font-bold text-[#1a4d2e]">lince ibérico (Lynx pardinus)</span> es el felino más amenazado del planeta y endémico de la Península Ibérica. Con sus características orejas terminadas en pinceles negros y su pelaje moteado, es un cazador especializado único.
            </p>

            <p>
                Estos majestuosos felinos pueden pesar entre 10 y 15 kg, con los machos siendo ligeramente más grandes que las hembras. Su dieta se basa principalmente en conejos, lo que los hace vulnerables a las fluctuaciones de esta presa.
            </p>

            <p>
                Gracias a los esfuerzos de conservación, la población ha pasado de menos de 100 individuos en 2002 a más de 1.500 en la actualidad, pero aún queda mucho trabajo por hacer.
            </p>
        </div>

        <div class="rounded-3xl overflow-hidden shadow-2xl mt-5">
            <img src="../assets/imagenes/imagen_lince_ellince.jpg" 
                 alt="Restauración del hábitat" 
                 class="w-full h-90 object-cover hover:scale-105 transition-transform duration-700">
        </div>

    </div>
</section>

<section class="bg-[#f4f1ea] py-20 px-4">
    <div class="max-w-6xl mx-auto">
        
        <div class="grid grid-cols-2 md:grid-cols-2 gap-y-16 gap-x-8 text-center">
            
            <div class="flex flex-col items-center">
                <span class="text-5xl md:text-6xl font-serif font-bold text-[#1a4d2e] mb-2">
                    1500+
                </span>
                <p class="text-gray-500 font-medium">Linces en libertad</p>
            </div>

            <div class="flex flex-col items-center">
                <span class="text-5xl md:text-6xl font-serif font-bold text-[#D2691E] mb-2">
                    10-15kg
                </span>
                <p class="text-gray-500 font-medium">Peso adulto</p>
            </div>

            <div class="flex flex-col items-center">
                <span class="text-5xl md:text-6xl font-serif font-bold text-[#1a4d2e] mb-2">
                    12-15
                </span>
                <p class="text-gray-500 font-medium">Años de vida</p>
            </div>

            <div class="flex flex-col items-center">
                <span class="text-5xl md:text-6xl font-serif font-bold text-[#D2691E] mb-2">
                    1-4
                </span>
                <p class="text-gray-500 font-medium ">Cachorros por camada</p>
            </div>

        </div>
    </div>
</section>

<section class="bg-[#f8f7f4] py-20 px-4">
    <div class="max-w-6xl mx-auto">
        
        <div class="text-center mb-16">
            <span class="bg-red-100 text-red-600 text-xs font-bold px-4 py-1.5 rounded-full uppercase  mb-6 inline-block">
                Amenaza ambiental
            </span>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-[#1a4d2e] mb-6">
                El impacto de la <span class="text-red-600">basura</span> en su hábitat
            </h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto leading-relaxed">
                La contaminación del hábitat del lince tiene consecuencias devastadoras para toda la cadena ecológica.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="bg-white p-10 rounded-3xl shadow-sm hover:shadow-xl transition-all group">
                <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center text-red-500 text-2xl mb-8 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-trash-can"></i>
                </div>
                <h3 class="text-xl font-bold text-[#1a4d2e] mb-4 font-serif">Ingestión de plásticos</h3>
                <p class="text-gray-500 leading-relaxed text-sm">    
                    Los residuos plásticos pueden ser ingeridos accidentalmente por los linces y sus presas, causando obstrucciones intestinales y envenenamiento.
                </p>
            </div>

            <div class="bg-white p-10 rounded-3xl shadow-sm hover:shadow-xl transition-all group">
                <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center text-red-500 text-2xl mb-8 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <h3 class="text-xl font-bold text-[#1a4d2e] mb-4 font-serif">Contaminación del agua</h3>
                <p class="text-gray-500 leading-relaxed text-sm">
                    Los residuos tóxicos contaminan las fuentes de agua, afectando a toda la fauna del ecosistema mediterráneo, incluyendo las presas del lince.
                </p>
            </div>

            <div class="bg-white p-10 rounded-3xl shadow-sm hover:shadow-xl transition-all group">
                <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center text-red-500 text-2xl mb-8 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-tree"></i>
                </div>
                <h3 class="text-xl font-bold text-[#1a4d2e] mb-4 font-serif">Degradación del hábitat</h3>
                <p class="text-gray-500 leading-relaxed text-sm">
                    La acumulación de basura degrada el hábitat natural, reduciendo las zonas de caza y cría disponibles para los linces.
                </p>
            </div>

        </div>
    </div>
</section>

  <section class="py-20 px-4 bg-white">
    <div class="max-w-4xl mx-auto">
        
        <span class="bg-gray-100 text-gray-600 text-xs font-bold px-4 py-1.5 rounded-full uppercase  mb-6 inline-block">
            Nuestra Respuesta
        </span>

        <h2 class="text-4xl md:text-5xl font-serif font-bold text-[#1a4d2e] mb-10 ">
            Como <span class="font-bold text-[#D2691E]">protegemos</span> su hogar
        </h2>

        <div class="space-y-6 text-gray-600 text-lg ">
           
        <div class="max-w-4xl mx-auto">
        
        <div class="space-y-12 mb-16">
            
            <div class="flex items-start gap-6 ">
                <div class="w-14 h-14 bg-white/10 rounded-2xl flex-shrink-0 flex items-center justify-center text-[#D2691E] text-2xl shadow-inner ">
                    <i class="fa-solid fa-leaf hover:scale-110"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-[#1a4d2e] mb-2 font-serif">Jornadas de limpieza</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Organizamos eventos regulares para retirar residuos de las zonas donde habita el lince.
                    </p>
                </div>
            </div>

            <div class="flex items-start gap-6">
                <div class="w-14 h-14 bg-white/10 rounded-2xl flex-shrink-0 flex items-center justify-center text-[#D2691E] text-2xl shadow-inner">
                    <i class="fa-solid fa-shield-halved hover:scale-110"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-[#1a4d2e] mb-2 font-serif">Vigilancia ambiental</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Patrullas voluntarias monitorizan las áreas protegidas para detectar vertidos ilegales.
                    </p>
                </div>
            </div>

            <div class="flex items-start gap-6">
                <div class="w-14 h-14 bg-white/10 rounded-2xl flex-shrink-0 flex items-center justify-center text-[#D2691E] text-2xl shadow-inner">
                    <i class="fa-solid fa-tree hover:scale-110"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-[#1a4d2e] mb-2 font-serif">Restauración del hábitat</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Reforestamos y recuperamos zonas degradadas para ampliar el territorio del lince.
                    </p>
                </div>
            </div>

        </div>

        <div class="rounded-3xl overflow-hidden shadow-2xl">
            <img src="../assets/imagenes/restauracion_habitats.jpg" 
                 alt="Restauración del hábitat" 
                 class="w-full h-80 object-cover hover:scale-105 transition-transform duration-700">
        </div>

    </div>

    </div>
</section>

</main>



<?php
/* INCLUIMOS EL FOOTER */
include '../partes/footer.php';
?>