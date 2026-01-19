<?php
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
$myparams['Paterno'] = $_POST['Paterno'];
$myparams['Materno'] = $_POST['Materno'];
$myparams['Curp'] = $_POST['Curp'];


$params = array(
	  array($myparams['Nombre'], SQLSRV_PARAM_IN),
	  array($myparams['Paterno'], SQLSRV_PARAM_IN),
	  array($myparams['Materno'], SQLSRV_PARAM_IN),
	  array($myparams['Curp'], SQLSRV_PARAM_IN)
	  );

	$callSP = "{call SP_BusquedaRC(?,?,?,?)}";
	$stmt = sqlsrv_query( $connSI, $callSP, $params);
	if( $stmt === false )
	{
		echo "Error in executing statement 3.\n";
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
                $cadena .= "<th>Paterno</th>";
                $cadena .= "<th>Materno</th>";
                $cadena .= "<th>Nacimiento</th>";
                $cadena .= "<th>Defunción</th>";
                $cadena .= "<th>Curp</th>";
                $cadena .= "</tr>";
				$cadena .= "</thead><tbody>";
				/*extraer los resultados*/	
			}
				$tr ="";
				$cadena .= "<tr class='".$tr."'>";
				$cadena .= "<td>".$row['Nombre']."</td>";
				$cadena .= "<td>".$row['ApPaterno']."</td>";
				$cadena .= "<td>".$row['ApMaterno']."</td>";
				$cadena .= "<td>".$row['Nacimiento']."</td>";
				$cadena .= "<td>".$row['Defuncion']."</td>";
                $cadena .= "<td>".$row['Curp']."</td>";
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


