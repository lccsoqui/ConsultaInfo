<?php
session_start();
require("../../config/conn.php");
require("../../funciones/fotos.class.inc.php");

/*get el numero de contrato*/
$fotoid = !empty($_POST['id']) ? $_POST['id'] : NULL;
$resultado = array();

/*detectar el post*/
if(!empty($_POST) and $fotoid != NULL and $_SESSION['login'] == true){
	/*crear el objeto foto*/
	$foto = new fotos($conn, $fotoid);
	$borrarFoto = $foto->borrarFoto();
	/*comprobar que se aya borrado*/
	if($borrarFoto == true){
		$resultado['affected'] = true;
		$resultado['idfoto'] = $fotoid;
			
		echo json_encode($resultado);
		}
	}
?>