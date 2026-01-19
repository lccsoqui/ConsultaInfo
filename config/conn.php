<?php
/*CONEXION A LA BASE DE DATOS*/

$serverName = "172.29.3.16"; 
//$connectionInfo = array( "Database"=>"CEE_MASTER", "UID"=>"malvarez", "PWD"=>"M95010116*", "CharacterSet" => "UTF-8");
$connectionInfo = [
    "Database" => "CEE_MASTER",
    "Uid" => "malvarez",
    "PWD" => "M95010116*",
	"CharacterSet" => "UTF-8",
    "Encrypt" => true,
    "TrustServerCertificate" => true
];
$connSI= sqlsrv_connect($serverName, $connectionInfo);
if( !$connSI) {
	echo "Conexión no se pudo establecer.<br />";
	die(print_r(sqlsrv_errors(), true));
}
	  
?>
