<?php
include '../config/db_config.php';

// Realiza la consulta a la base de datos
$consulta_estadistica = mysqli_query($conn, 'SELECT * FROM historial');

// Inicializa un array para almacenar los datos
$datos_fecha = [];

// Recorre los resultados de la consulta y agrega los valores al array
while ($fila = mysqli_fetch_assoc($consulta_estadistica)) {
    $datos_fecha[] = $fila['fecha'];
    $datos_dinero[] = $fila['saldo'];
}

// Convierte el array a formato JSON para usarlo en JavaScript
$fecha_json = json_encode($datos_fecha);
$dinero_json = json_encode($datos_dinero);
