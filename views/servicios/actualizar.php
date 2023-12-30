<?php include_once __DIR__ . '/../templates/menu-usuario.php'; ?>

<h1 class="font-bold text-white text-center text-3xl py-8">Actualizar Servicio</h1>
<p class="text-center mb-6">Modifica el o los valores del formulario</p>

<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

<form method="POST">
    <?php include_once __DIR__ . '/formulario.php'; ?>
    <input type="submit" value="Guardar" class="bg-blue-600 rounded-lg p-3">
</form>