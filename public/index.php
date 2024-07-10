<?php
$ultima_coincidencia = include '../app/procesarRegistrosChat.php';
$mostrar_historial = include '../app/almacenarHistorialPagos.php';
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <title>Papel en blanco</title>
    <link rel='stylesheet' href='css/grid.css'>
    <link rel='stylesheet' href='css/contenedor1.css'>
</head>

<body>
    <div class='contenedor-grid'>
        <div class='contenedor'>
            Dinero: <span>$<?php echo $ultima_coincidencia;
?></span>
        </div>
        <div class='contenedor'>
            <h1>Historial</h1>
            <?php echo $mostrar_historial;
?>
        </div>
        <div class='contenedor'>3</div>
        <div class='contenedor'>4</div>
    </div>

</body>

</html>