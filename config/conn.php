<?php
/*CONEXION A LA BASE DE DATOS*/


		$serverName = "172.16.2.15"; 
		$connectionInfo = array( "Database"=>"DBSIIF", "UID"=>"ConsultaSIIF", "PWD"=>"FIISCon1", "CharacterSet" => "UTF-8");
		$connSI= sqlsrv_connect($serverName, $connectionInfo);
		if( $connSI ) {
			echo "";
	   }else{
			echo "Conexión no se pudo establecer SI.<br />";
			//die(print_r( sqlsrv_errors(), true));
	   }
		



?>
