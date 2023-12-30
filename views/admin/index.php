<?php include_once __DIR__ . '/../templates/menu-usuario.php'; ?>

<h1 class="font-bold text-white text-center text-3xl py-12">Panel de Administrador</h1>

<h2 class="font-bold text-white text-center text-2xl mb-4">Buscar Citas</h2>
<div>
    <form action="">
        <div class="flex justify-between items-center gap-8 mb-4">
            <label for="fecha">Fecha</label>
            <input 
                type="date"
                id="fecha"
                class="w-full text-gray-900 p-2 rounded-lg"
                value="<?php echo $fecha; ?>"
            >
        </div>            
    </form>
</div>

<?php 
    if(count($citas) === 0) {
        echo '<p class="bg-red-600 rounded-lg text-center p-2">No Hay Citas En Esta Fecha</p>';
    }
?>

<div>
    <ul>
        <?php 
            $idCita = 0;
            foreach ($citas as $key => $cita) { 
                if ($idCita !== $cita->id) {
                    $total = 0;
        ?>
        </li> <!-- Cerrar el <li> anterior, si existe -->
        <li class="bg-white text-gray-900 p-4 rounded-lg font-bold mb-4">
            <h3 class="font-bold text-blue-600 text-center text-xl mb-2">Detalles de la cita</h3>
            <p>ID: <span><?php echo $cita->id; ?></span></p>
            <p>Hora: <span><?php echo $cita->hora; ?></span></p>
            <p>Cliente: <span><?php echo $cita->cliente; ?></span></p>
            <p>Email: <span><?php echo $cita->email; ?></span></p>
            <p>Teléfono: <span><?php echo $cita->telefono; ?></span></p> 

            <h3 class="font-bold text-blue-600 text-center text-xl mb-2">Servicios</h3>
            <?php
                $idCita = $cita->id;
            } // End if 
                $total += $cita->precio;
            ?>
            <p><?php echo $cita->servicio . " " . $cita->precio; ?></p>
            <?php  
                $actual = $cita->id;
                $proximo = $citas[$key + 1]->id ?? 0;
                
                if (esUltimo($actual, $proximo)) { ?>
                    <p class="text-blue-600">Total: $<span><?php echo $total; ?></span></p>

                    <form class="flex justify-end" action="/api/eliminar" method="POST">
                        <input 
                            type="hidden"
                            name="id"
                            value="<?php echo $cita->id; ?>"
                        >

                        <button type="submit">
                            <svg class="w-7 h-7 text-red-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                <path d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z"/>
                            </svg>
                        </button>
                    </form>
            <?php    
                }
            ?>
        <?php } // End foreach ?>
        </li> <!-- Cerrar el último <li> fuera del bucle -->
    </ul>
</div>

<?php 
    $script = "<script src='js/buscador.js'></script>";

?>

