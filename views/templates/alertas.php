<?php 
foreach ($alertas as $key => $mensajes):
    foreach ($mensajes as $mensaje):
        // Determinar la clase basada en el valor de $key
        $clase = ($key === 'error') ? 'bg-red-600' : (($key === 'exito') ? 'bg-green-600' : '');

        // Agregar otras clases y estilos según sea necesario
        $clase .= ' m-4 text-base p-1 rounded-md text-center';
?>
        <div class="<?php echo $clase; ?>">
            <?php echo $mensaje; ?>    
        </div>
<?php
    endforeach;
endforeach;
?>