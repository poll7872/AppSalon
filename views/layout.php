<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Salón</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/dist/output.css">
    <script src='/js/menu.js'></script>
</head>
<body class="font-poppins">

    <div class="md:grid md:grid-cols-2 flex flex-col">
        <div class="bg-hero-pattern bg-cover bg-center h-52 md:h-full"></div>
        <div class="bg-slate-900 text-white px-6 min-h-screen">
            <?php echo $contenido; ?>
        </div>
    </div>
    
    <?php
        echo $script ?? '';         
    ?>

</body>
</html>