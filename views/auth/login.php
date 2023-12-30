<h1 class="font-bold text-white text-center text-3xl py-12">Login</h1>
<p class="text-center mb-3">Inicia sesión con tus datos</p>

<?php include_once __DIR__ . "/../templates/alertas.php"; ?>

<form action="/" method="POST" class="w-full">
    <div class="flex items-center gap-16 mb-8">
        <label for="email">Email</label>
        <input 
            type="email"
            id="email"
            placeholder="Ingresa tu correo"
            name="email"
            class="w-full text-gray-900 p-2 rounded-lg"
        >
    </div>
    <div class="flex items-center gap-3 mb-8">
        <label for="password">Contraseña</label>
        <input 
            type="password"
            id="password"
            placeholder="Ingresa tu contraseña"
            name="password"
            class="w-full text-gray-900 p-2 rounded-lg"
        >
    </div>
    
    <input type="submit" value="Iniciar Sesión" class="cursor-pointer md:w-32 w-full p-3 bg-blue-600 rounded-md">
</form>

<div class="grid text-center my-5">
    <a href="/crear-cuenta" class="hover:underline mb-4">¿Aún no tienes una cuenta? Crea una</a>
    <a href="/olvide" class="hover:underline mb-3">¿Olvidaste tu contraseña?</a>
</div>