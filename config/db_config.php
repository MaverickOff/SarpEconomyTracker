<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'historialpagos';

$conn = mysqli_connect( $servername, $username, $password, $dbname );

if ( !$conn ) {
    die( 'La conexión falló ☹️'. '<br>' );
}
