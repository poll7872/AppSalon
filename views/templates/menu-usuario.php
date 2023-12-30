<div class="relative flex justify-end my-3" id="user-menu">
    <button class="flex items-center">
        <span class="mr-2">Hola, <?php echo $nombre ?? ''; ?></span>
        <svg class="w-[16px] h-[16px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1"/>
        </svg>
    </button>
    <div class="absolute top-6 mt-2 w-48 bg-white border rounded-lg shadow-lg hidden" id="user-menu-content">
    <?php if (isset($_SESSION["admin"])) { ?>

        <a href="/admin" class="block px-4 py-2 text-gray-800 hover:bg-gray-300 rounded-lg">Ver Citas</a>
        <a href="/servicios" class="block px-4 py-2 text-gray-800 hover:bg-gray-300 rounded-lg">Ver servicios</a>

    <?php } else { ?>
        <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-300 rounded-lg">Perfil</a>
        <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-300 rounded-lg">Historial</a>
    <?php } ?>
        <a href="/logout" class="block px-4 py-2 text-gray-800 hover:bg-gray-300 rounded-lg">Cerrar Sesión</a>
    </div>
</div>

