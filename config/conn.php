<?php
/*CONEXION A LA BASE DE DATOS*/

// Load environment variables
require_once(__DIR__ . '/env.php');

$serverName = env('DB_SERVER');
$connectionInfo = [
    "Database" => env('DB_NAME'),
    "Uid" => env('DB_USER'),
    "PWD" => env('DB_PASSWORD'),
	"CharacterSet" => env('DB_CHARSET', 'UTF-8'),
    "Encrypt" => env('DB_ENCRYPT', true),
    "TrustServerCertificate" => env('DB_TRUST_CERT', true)
];
$connSI= sqlsrv_connect($serverName, $connectionInfo);
if( !$connSI) {
	echo "Conexión no se pudo establecer.<br />";
	die(print_r(sqlsrv_errors(), true));
}
	  
?>
