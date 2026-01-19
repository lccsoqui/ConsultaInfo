<?php
session_name('pi-login');
session_start();
require('../funciones/query.class.inc.php');
require("../sources/msg-file.php");
require('../funciones/config.php');
include("../config/conn.php");

if(empty($_SESSION['id-usuario']) or !isset($_SESSION['login']) or $_SESSION['login'] != true){
	session_destroy();
	header("LOCATION: ../index.php?session=false");
	
	}
/*
foreach($_POST as $nombre_campo => $valor){
	echo $nombre_campo."=".$valor;
 }
*/
if (isset($_POST['Nombre']) and isset($_POST['Nombre']))
{
?>
<div class="lista-contratos">
<?php

ini_set("max_execution_time", 300);
set_time_limit(0);

$myparams['Nombre'] = $_POST['Nombre'];

$params = array(
	  array($myparams['Nombre'], SQLSRV_PARAM_IN)
	  );

	$callSP = "{call BuscaCiudadano(?)}";
	$stmt = sqlsrv_query( $connSI, $callSP, $params);
	if( $stmt === false )
	{
		echo "Error in executing statement 3.\n";
		echo "Stored procedure: BuscaCiudadano\n";
		echo "This error typically means the PostgreSQL linked server 'postgres-3.17' is not properly configured.\n";
		echo "Please contact your database administrator to:\n";
		echo "1. Verify the linked server exists: EXEC sp_linkedservers;\n";
		echo "2. Test the connection: EXEC sp_testlinkedserver N'postgres-3.17';\n";
		echo "3. Reconfigure ODBC connection if needed.\n\n";
		die( print_r( sqlsrv_errors(), true));
	}
    $cadena = "";
	$i=1;

	while ($row=sqlsrv_fetch_array($stmt)) {
		if ($i ==1) {
				$cadena .= "<table id=\"example\" class=\"display\" style=\"width:100%\">";
				$cadena .= "<thead>";
				$cadena .= "<tr>";
				$cadena .= "<th>Nombre</th>";
				$cadena .= "<th>Domicilio</th>";
                $cadena .= "<th>Colonia</th>";
                $cadena .= "<th>Municipio</th>";
				$cadena .= "<th>Teléfonos</th>";
				$cadena .= "<th>EMail</th>";
				$cadena .= "<th>BD</th>";
                $cadena .= "</tr>";
				$cadena .= "</thead><tbody>";	
			} 
				$tr ="";
				$cadena .= "<tr class='".$tr."'>";
			$cadena .= "<td>".htmlspecialchars(strtoupper($row['Nombre'] ?? ''))."</td>";
			$cadena .= "<td>".htmlspecialchars(strtoupper($row['Domicilio'] ?? ''))."</td>";
			$cadena .= "<td>".htmlspecialchars(strtoupper($row['Colonia'] ?? ''))."</td>";
            $cadena .= "<td>".htmlspecialchars(strtoupper($row['Municipio'] ?? ''))."</td>";
			$cadena .= "<td>".($row['TelParticular'] ?? '').' '.($row['TelTrabajo'] ?? '').' '.($row['TelCelular'] ?? '').' '.($row['TelOtro'] ?? '')."</td>";
			$cadena .= "<td>".htmlspecialchars(strtoupper($row['Email'] ?? ''))."</td>";
			$cadena .= "<td>".($row['Server'] ?? '')."<br/>".($row['BD'] ?? '')."<br/>".($row['Tabla'] ?? '')."</td>";
				$cadena .= "</td>";
				$cadena .= "</tr>";
			$i++;			
			}	
			$cadena .= "</tbody></table>";
			
			if ($i==1)
			{
				$cadena = "<div class=\"info\" id=\"lista-contratos\">".$mensaje['1003']."</div>";	
			}
	 echo $cadena;		
		
	 sqlsrv_free_stmt($stmt);
	 sqlsrv_close($connSI);

?>
</div>
<?php
}

?>


