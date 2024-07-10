<?php
include '../config/db_config.php';

function insertar_saldo($conn, $saldo) {
    $query = "INSERT INTO `historial`(`id`, `saldo`, `fecha`) VALUES ('', $saldo, NOW())";
    $resultado = mysqli_query($conn, $query);
    if (!$resultado) {
        echo "Hubo un error al insetar los datos: " . mysqli_error($conn);
        return false;
    }
    return true;
}



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
    // Consultar último registro de la base de datos
    $consulta_ultimo_registro = mysqli_query($conn, "SELECT * FROM historial ORDER BY id DESC LIMIT 1");
    $ultimo_registro = mysqli_fetch_assoc($consulta_ultimo_registro);

    if (!empty($matches)) {
        $procesar_saldo_actual = str_replace(',','',end($matches)[0]);
        $saldo_actual = intval($procesar_saldo_actual);
        if ($ultimo_registro !== null) {
            $saldo_ultimo_registro = intval($ultimo_registro['saldo']);
            if ($saldo_actual != $saldo_ultimo_registro) {
                insertar_saldo($conn, $saldo_actual);
                return $saldo_actual;
            } else {
                return $saldo_ultimo_registro;
            }
        }else {
            echo "No se encontró ningún registro en la base de datos. :(";
            insertar_saldo($conn, $saldo_actual);
            return $saldo_actual;
        }
    } else {
        //Acceder al último saldo de la base de datos
        if ($ultimo_registro !== null) {
            $saldo_ultimo_registro = intval($ultimo_registro['saldo']);
            return $saldo_ultimo_registro;
        } else {
            echo "No se encontró ningún registro en la base de datos.";
            $saldo_ultimo_registro = 0;
            insertar_saldo($conn, $saldo_ultimo_registro);
            return $saldo_ultimo_registro;
        }
 }
} else {
    echo "El archivo no existe";
}


?>