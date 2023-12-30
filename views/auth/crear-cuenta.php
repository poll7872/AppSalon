<h1 class="font-bold text-white text-center text-3xl py-8">Crear Cuenta</h1>
<p class="text-center mb-3">Llena el siguiente formulario para crear una cuenta</p>

<?php 
    include_once __DIR__ ."/../templates/alertas.php";
?>

<form action="/crear-cuenta" method="POST" class="w-full">
    <div class="flex items-center gap-11 mb-6">
        <label for="nombre">Nombre</label>
        <input 
            type="text"
            id="nombre"
            placeholder="Ingresa tu nombre"
            name="nombre"
            class="w-full text-gray-900 p-2 rounded-lg"
            value="<?php echo s($usuario->nombre); ?>"
        >
    </div>
    <div class="flex items-center gap-11 mb-6">
        <label for="apellido">Apellido</label>
        <input 
            type="text"
            id="apellido"
            placeholder="Ingresa tu apellido"
            name="apellido"
            class="w-full text-gray-900 p-2 rounded-lg"
            value="<?php echo s($usuario->apellido); ?>"
        >
    </div>
    <div class="flex items-center gap-10 mb-6">
        <label for="telefono">Telefono</label>
        <input 
            type="tel"
            id="telefono"
            placeholder="Ingresa tu telefono"
            name="telefono"
            class="w-full text-gray-900 p-2 rounded-lg"
            value="<?php echo s($usuario->telefono); ?>"           
        >
    </div>    
    <div class="flex items-center gap-16 mb-6">
        <label for="email">Email</label>
        <input 
            type="email"
            id="email"
            placeholder="Ingresa tu correo"
            name="email"
            class="w-full text-gray-900 p-2 rounded-lg"
            value="<?php echo s($usuario->email); ?>"
        >
    </div>
    <div class="flex items-center gap-3 mb-6">
        <label for="password">Contraseña</label>
        <input 
            type="password"
            id="password"
            placeholder="Ingresa tu contraseña"
            name="password"
            class="w-full text-gray-900 p-2 rounded-lg"
        >
    </div>

    <input type="submit" value="Crear Cuenta" class="md:w-36 w-full p-3 bg-blue-600 rounded-md cursor-pointer">

</form>

<div class="grid text-center my-5">
    <a href="/" class="hover:underline mb-4">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/olvide" class="hover:underline mb-3">¿Olvidaste tu contraseña?</a>
</div>