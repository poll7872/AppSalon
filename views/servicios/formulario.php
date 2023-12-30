<div class="flex items-center gap-7 mb-6">
    <label for="nombre">Nombre</label>
    <input 
        type="text"
        id="nombre"
        placeholder="Ingresa el nombre del servicio"
        name="nombre"
        class="w-full text-gray-900 p-2 rounded-lg"
        value="<?php echo s($servicio->nombre); ?>"
    >
</div>
<div class="flex items-center gap-11 mb-6">
    <label for="precio">Precio</label>
    <input 
        type="number"
        id="precio"
        placeholder="Ingresa el precio"
        name="precio"
        class="w-full text-gray-900 p-2 rounded-lg"
        value="<?php echo s($servicio->precio); ?>"
    >
</div>