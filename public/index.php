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
            Dinero: <span>$
                <?php echo $ultima_coincidencia;
                ?>
            </span>
        </div>
        <div class='contenedor'>
            <h1>Historial</h1>
            <?php echo $mostrar_historial;
            ?>
        </div>
        <div class='contenedor'>
            <div>
                <canvas id="estadisticas-sarp" width="15" height="5">
            </div>
            </canvas>
        </div>
        <div class='contenedor'>4</div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    const ctx = document.getElementById("estadisticas-sarp").getContext("2d");
    const etiquetas = ["Enero", "Febrero", "Marzo", "Abril", "Mayo"];
    const data = {
        labels: etiquetas,
        datasets: [{
            label: "Dinero ganado",
            data: [1000, 5600, 13200, 15555, 30000],
            borderColor: "rgb(75, 192, 192)",
            tension: 0.1,
        }, ],
    };

    const config = {
        type: "line",
        data: data,
    };

    new Chart(ctx, config);
    </script>
</body>

</html>