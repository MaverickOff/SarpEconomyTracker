<?php
include '../config/db_config.php';

$saldos_antiguos = [];

for ( $i = 0; $i < 5; $i++ ) {
    $resultado = mysqli_query( $conn, "SELECT * FROM historial ORDER BY id DESC LIMIT 1 OFFSET $i" );
    $fila = mysqli_fetch_assoc( $resultado );
    if ( $fila ) {
        $saldos_antiguos[] = $fila;
    }
}

$mostrar_saldo_antiguo = '';

foreach ( $saldos_antiguos as $index => $saldo ) {
    $mostrar_saldo_antiguo .= '<span class="saldo-' . ( $index + 1 ) . '">';
    $mostrar_saldo_antiguo .= '$' . $saldo[ 'saldo' ] . '<br>';
    $mostrar_saldo_antiguo .= $saldo[ 'fecha' ];
    $mostrar_saldo_antiguo .= '</span><hr>';
}

mysqli_close( $conn );

return $mostrar_saldo_antiguo;

