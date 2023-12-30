<?php include_once __DIR__ . '/../templates/menu-usuario.php'; ?>

<h1 class="font-bold text-white text-center text-3xl py-12">Crear Nueva Cita</h1>
<p class="text-center mb-6">Elige tus servicios y coloca tus datos</p>

<div id="app">

    <nav class="tabs flex flex-col gap-3 md:flex-row md:justify-between md:items-center md:bg-blue-600 w-full font-bold rounded-lg mb-6">
        <button class="bg-blue-600 rounded-lg cursor-pointer w-full h-auto hover:bg-white hover:text-blue-600" data-paso="1">Servicios</button>
        <button class="bg-blue-600 rounded-lg cursor-pointer w-full h-auto hover:bg-white hover:text-blue-600" data-paso="2">Información cita</button>
        <button class="bg-blue-600 rounded-lg cursor-pointer w-full h-auto hover:bg-white hover:text-blue-600" data-paso="3">Resumen</button>
    </nav>

    <div class="mb-6 mt-6 seccion" id="paso-1">
        <h2 class="font-bold text-white text-center text-2xl mb-4">Servicios</h2>
        <p class="text-center mb-4">Elige tus servicios a continuación</p>
        <div id="servicios" class="grid md:grid-cols-2 gap-4"></div>
    </div>

    <div class="mb-6 hidden seccion" id="paso-2">
        <h2 class="font-bold text-white text-center text-2xl mb-4">Tus Datos y Cita</h2>
        <p class="text-center mb-4">Coloca tus datos y fecha de tu cita</p>

        <form>
            <div class="flex justify-between items-center gap-8 mb-4">
                <label for="nombre">Nombre</label>
                <input 
                    type="text"
                    id="nombre"
                    class="w-full text-white p-2 rounded-lg cursor-not-allowed"
                    value="<?php echo $nombre; ?>"
                    disabled
                >
            </div>
            <div class="flex justify-between items-center gap-12 mb-4">
                <label for="fecha">Fecha</label>
                <input 
                    type="date"
                    id="fecha"
                    min="<?php echo date('Y-m-d', strtotime('+1 day') ); ?>"
                    class="w-full text-gray-900 p-2 rounded-lg"
                >
            </div>
            <div class="flex justify-between items-center gap-[3.7rem] mb-4">
                <label for="hora">Hora</label>
                <input 
                    type="time"
                    id="hora"
                    class="w-full text-gray-900 p-2 rounded-lg"
                >
            </div>
            <input type="hidden" id="id" value="<?php echo $id; ?>">
        </form>
    </div>

    <div class="mb-6 hidden seccion contenido-resumen" id="paso-3">
        <h2 class="font-bold text-white text-center text-2xl mb-4">Resumen</h2>
        <p class="text-center mb-4">Verifica que la información sea correcta</p>    
    </div>

    <div id="containerPag" class="flex flex-col md:flex-row">
        <button 
            id="anterior"
            class="p-2 md:w-32 bg-blue-600 rounded-lg mb-4" 
        >
            &laquo; Anterior
        </button>
        <button 
            id="siguiente"
            class="p-2 md:w-32 bg-blue-600 rounded-lg mb-4" 
        >
            Siguiente &raquo; 
        </button>
    </div>
</div>

<?php 
    $script = "
        <script src='js/app.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>

    "; 
?>