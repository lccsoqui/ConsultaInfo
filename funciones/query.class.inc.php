<?php
require('db.class.inc.php');

class querys extends db{
	
	protected $data_base;//conexion a la base de datos
	
	/*constructor*/
	public function __construct(){
		/*conectarse a la base de datos*/
		$this->data_base = new db();
		}
	
	/*crear registros*/
	public function insertarRegistro($query_string, $bind_array = array()){
		/*preparar el query*/
		$this->data_base->query($query_string);
		/*bind parametros*/
		if(is_array($bind_array)){
			/*loop to bind*/
			foreach($bind_array as $key => $value){
				/*bind el parametro*/
				$this->data_base->bind($key, $value);
				}
			}
		/*ejecutar el query*/
		if($this->data_base->execute()){
			/*si el query se ejecuto bien entonces regresar true*/
			return true;
			}else{
				/*si ocurrio un problema con el query entonces regresar false*/
				return false;
				}
		}
	
	/*ejecutar querys genericos*/
	public function ejecutarQuery($query_string, $bind_array = array()){
		/*preparar el query*/
		$this->data_base->query($query_string);
		/*bind parametros*/
		if(is_array($bind_array)){
			/*loop to bind*/
			foreach($bind_array as $key => $value){
				/*bind el parametro*/
				$this->data_base->bind($key, $value);
				}
			}
		/*ejecutar el query*/
		if($this->data_base->execute()){
			/*si el query se ejecuto bien entonces regresar true*/
			return true;
			}else{
				/*si ocurrio un problema con el query entonces regresar false*/
				return false;
				}
		}
	
	/*regresar multiples resultados*/
	public function traerMultiplesResultados($query_string, $bind_array = array()){
		/*set array de resultados*/
		$datos_catalogo = array();
		/*preparar el query*/
		$this->data_base->query($query_string);
		/*bind parametros*/
		if(is_array($bind_array)){
			/*bind to bind*/
			foreach($bind_array as $key => $value){
				/*bind los parametros*/
				$this->data_base->bind($key, $value);
				}
			}
		/*ejecutar el query*/
		if($rows = $this->data_base->resultset()){
			/*si se ejecuto bien entonces regresamos el row*/
			return $rows;
			}
		}
	
	/*regresar un solo resultado*/
	public function traerSoloResultado($query_string, $bind_array = array()){
		/*set array de resultados*/
		$datos_catalogo = array();
		/*preparar el query*/
		$this->data_base->query($query_string);
		/*bind parametros*/
		if(is_array($bind_array)){
			/*bind to bind*/
			foreach($bind_array as $key => $value){
				/*bind los parametros*/
				$this->data_base->bind($key, $value);
				}
			}
		/*ejecutar el query*/
		if($row = $this->data_base->single()){
			/*si se ejecuto bien entonces regresamos el row*/
			return $row;
			}
		}
	/*ultimo id afectado*/
	public function ultimoIdInsertado(){
		/*regresar el ultimo id afectado*/
		return $this->data_base->lastInsertId();
		}
	}
?>



