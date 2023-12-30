<h1 class="font-bold text-white text-center text-3xl py-12">Restablecer Contraseña</h1>
<p class="text-center mb-3">Coloca tu nueva contraseña a continuación</p>

<?php include_once __DIR__ . "/../templates/alertas.php"; ?>

<?php if($error) return; ?>
<form method="POST" class="w-full">
    <div class="flex items-center gap-3 mb-8">
        <label for="password">Contraseña</label>
        <input 
            type="password"
            id="password"
            placeholder="Ingresa tu nueva contraseña"
            name="password"
            class="w-full text-gray-900 p-2 rounded-lg"
        >
    </div>
    
    <input type="submit" value="Guardar Nueva Contraseña" class="cursor-pointer md:w-64 w-full p-3 bg-blue-600 rounded-md">
</form>

<div class="grid text-center my-20">
    <a href="/" class="hover:underline mb-3">¿Ya tienes una cuenta? Inicia Sesiòn</a>
    <a href="/crear-cuenta" class="hover:underline mb-4">¿Aún no tienes una cuenta? Crea una</a>
</div>
