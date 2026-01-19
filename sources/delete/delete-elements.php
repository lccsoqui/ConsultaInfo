<?php
session_start();
require("../../config/conn.php");
require('../../funciones/query.class.inc.php');
require("../../funciones/validar.formularios.class.inc.php");
require("../../funciones/borrar.elementos.class.php");

/*comprobar que seas POST*/
if(!empty($_POST) and $_SESSION['login'] == true){
	/*obtener los datos*/
	$dato_array = count($_POST['selected-item']) ? $_POST['selected-item'] : array();
	$tipo = $_POST['tipo'];
	$resultados = array();
	$total_borrados = 0;
	$query = "";
	$resultados['ok'] = false;
	$q = new querys();
	
	/*comprobar que sea array*/
	if(!empty($dato_array) and is_array($dato_array)){
		/************** DETERMINAR EL TIPO DE ELEMENTO **************/
		switch($tipo){
			case 'contratos':
				$query 	= "DELETE FROM `contratos` WHERE ID = ? AND ID NOT IN (SELECT AA.ID_CONTRATO FROM `avances` AA) AND ID NOT IN (SELECT AF.ID_CONTRATO FROM `avance_fotografico` AF) AND ID NOT IN (SELECT E.ID_CONTRATO FROM `expediente` E) AND ID NOT IN (SELECT B.id_obra FROM `bitacora_obra` B); ";
				break;
			case 'estudios':
				$query = "DELETE FROM `estudios` WHERE ID = ?;";
			break;
			case 'avances':
				$query = "DELETE FROM `avances` WHERE ID = ?;";
			break;
			case 'fotos':
				$query = "";
			break;
			case 'convenios':
				$query = "DELETE FROM `convenios_modificatorios` WHERE ID = ?;";
			break;
			case 'expediente':
				$query = "DELETE FROM `expediente` WHERE ID = ?;";
			break;
			case 'eventos':
				$query = "DELETE FROM `licitaciones_eventos` WHERE id = ?;";
			break;
			case 'licitaciones':
				$query = "DELETE FROM `licitaciones` WHERE id = ? AND id NOT IN (SELECT le.id_licitacion FROM `licitaciones_eventos` le);";
			break;
			}





		/*determinar que no venga el query*/
		if(!empty($query)){
			/*crear objeto* borrar*/
			$borrar = new borrar($conn);
			/*si biene el query loop para recorrer los elementos seleccionados*/
			foreach($dato_array as $valor){
				/*comprobar query*/
				if($borrar->borrarElementos($query, $valor) == true){
					/*si se borro exitosamente icrementar uno*/
					$total_borrados += 1;
					}
				}
			}
		/*comprobar que se ayan borrado*/
		if($total_borrados > 0){
			/*si se borro todo bien*/
			$resultados['ok'] = true;
			$resultados['totalBorrados'] = $total_borrados;
			}else{
				/*si no se borro nada entonces*/
				$resultados['ok'] = false;
				}
		
		/*mandar los resultados*/
		echo json_encode($resultados);
		}
	}
?>