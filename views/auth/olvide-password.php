<h1 class="font-bold text-white text-center text-3xl py-12">Restablecer Contraseña</h1>
<p class="text-center mb-3">Restablece tu contraseña ingresando tu email a continuación</p>

<?php include_once __DIR__ . "/../templates/alertas.php"; ?>

<form action="/olvide" method="POST" class="w-full">
    <div class="flex items-center gap-12 mb-8">
        <label for="email">Email</label>
        <input 
            type="email"
            id="email"
            placeholder="Ingresa tu correo"
            name="email"
            class="w-full text-gray-900 p-2 rounded-lg"
        >
    </div>
    
    <input type="submit" value="Enviar Instrucciones" class="md:w-48 cursor-pointer w-full p-3 bg-blue-600 rounded-md">
</form>

<div class="grid text-center my-5">
    <a href="/" class="hover:underline mb-4">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/crear-cuenta" class="hover:underline mb-4">¿Aún no tienes una cuenta? Crea una</a> 
</div>