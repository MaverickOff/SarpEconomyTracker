<?php
include '../config/db_config.php';

$file = 'c:\Users\dougl\OneDrive\Documentos\GTA San Andreas User Files\SAMP\chatlog.txt';
$ultima_coincidencia = '';

if ( file_exists( $file ) ) {
    $file_content = file_get_contents( $file );

    $cadena_banco = '/Banco: \\[\\$([\\d,]+)\\]/';
    $cadena_nuevo_balance = '/Nuevo balance: \\{FFFFFF\\}\\$([\\d,]+)/';

    $matches_banco = [];
    $matches_nuevo_balance = [];

    preg_match_all( $cadena_banco, $file_content, $matches_banco, PREG_OFFSET_CAPTURE );
    preg_match_all( $cadena_nuevo_balance, $file_content, $matches_nuevo_balance, PREG_OFFSET_CAPTURE );

    $matches = array_merge( $matches_banco[ 1 ], $matches_nuevo_balance[ 1 ] );

    usort($matches, function($a, $b){
        return $a[1] - $b[1];
    });

  
    
    $ultimo_saldo = mysqli_query($conn, "SELECT * FROM historial ORDER BY id DESC LIMIT 1");
    $fila_a = mysqli_fetch_assoc($ultimo_saldo);
    $fila_a = intval($fila_a['saldo']);

    if (empty($matches)) {
        //Acceder al último saldo de la base de datos
        return $fila_a;

    } else {
        if ($ultima_coincidencia == $fila_a) {
            return $ultima_coincidencia;
        } elseif ($ultima_coincidencia != $fila_a) {
            $ultima_coincidencia = str_replace(',', '', end($matches)[0]);
            $ultima_coincidencia = intval($ultima_coincidencia);
            $insertar_saldo = mysqli_query($conn, "INSERT INTO `historial`(`id`, `saldo`, `fecha`) VALUES ('','$ultima_coincidencia', NOW())");
        return $ultima_coincidencia;
        } else {
            return $fila_a;
        }
 }
} else {
    // Aquí puedes manejar el caso cuando el archivo no existe
    echo "El archivo no existe";
}


?>
