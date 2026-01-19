<?php

class usuario{
	
	var $db;//conexciona la base de datos
	private $id_usuario;//id del usuario
	private $usuario;//usuario
	private $password;//contraseña del usuario
	private $nombre_usuario;//nombre del usuario
	private $email;//email del usuario
	
	/*constructor*/
	function __construct($conn, $id = NULL){
		$this->db = $conn;//conexcion a la base de datos
		$this->id_usuario = $id;//id del usuario
		/*comprobar si biene el id del usuario*/
		if(!is_null($this->id_usuario)){
			/*si no biene null entonces cargar los datos del usuario*/
			$this->datosUsuario();
			}
		}
	
	/*crear un nuevo usuario*/
	public function crearUsuario($id_cliente, $usuario_, $password_, $nombre_usuario_, $email_){
		/*generar salt*/
		$salt = self::generarHas();
		/*crear password*/
		$newPass = hash("sha512", $password_.$salt);
		/*query*/
		$sql_query = "INSERT INTO `usuarios` (ID_CLIENTE, USUARIO, PASSWORD, NOMBRE, EMAIL, SALT) VALUES (?, ?, ?, ?, ?, ?);";
		/*preparar query*/
		$query = $this->db->prepare($sql_query);
		/*comprobar query*/
		if($query === false){
			trigger_error('Ocurrio un problema con el query: ' . $sql_query . ' Error: ' . $this->db->error, E_USER_ERROR);
			}
		/*bind los resultados*/
		$query->bind_param('isssss', $id_cliente, $usuario_, $newPass, $nombre_usuario_, $email_, $salt);
		/*ejecutar query*/
		$query->execute();
		/*comprobar que se ejecutar bien el query*/
		if($query->affected_rows > 0){
			return true;
			}else{
				return false;
				}
		}
	/*borrar usuario*/
	public function borrarUsuario(){
		if(!empty($this->id_usuario) and !is_null($this->id_usuario) and strlen($this->id_usuario) > 0){
			/*query*/
			$sql_query = "DELETE FROM `usuarios` WHERE ID = ?;";
			/*preparar query*/
			$query = $this->db->prepare($sql_query);
			/*comprobar query*/
			if($query === false){
				trigger_error('Ocurrio un problema con el query: ' . $sql_query . ' Error: ' . $this->db->error, E_USER_ERROR);
				}
			/*bind los resultados*/
			$query->bind_param('i', $this->id_usuario);
			/*ejecutar query*/
			$query->execute();
			/*comprobar que se ejecutar bien el query*/
			if($query->affected_rows > 0){
				return true;
				}else{
					return false;
					}
				}
		}
	/*cambiar la contraseña*/
	public function changePassword($newPassword){
		/*query*/
		$sql_query = "UPDATE `contratistas` SET PASSWORD = ? WHERE ID = ?;";
		/*preparar queery*/
		$query = $this->db->prepare($sql_query);
		/*comprobar query*/
		if($query === false){
			trigger_error('Ocurrio un problema con el query: ' . $sql_query . ' Error: ' . $this->db->error, E_USER_ERROR);
			}
		/*bind los resultados*/
		$query->bind_param('si', $newPassword, $this->id_usuario);
		/*ejecutar query*/
		$query->execute();
		/*comprobar que se ejecutar bien el query*/
		if($query->affected_rows > 0){
			return true;
			}else{
				return false;
				}
		}	
	/*funcion para cargar los datos del usuario*/
	private function datosUsuario(){
		if(!empty($this->id_usuario) and strlen($this->id_usuario) > 0){
			/*query*/
			$sql_query = "SELECT USUARIO, PASSWORD, NOMBRE, EMAIL FROM `usuarios` WHERE ID = ?;";
			/*preparar el query*/
			$query = $this->db->prepare($sql_query);
			/*comprobar query*/
			if($query === false){
				trigger_error('Ocurrio un problema con el query: ' . $sql_query . ' Error: ' . $this->db->error, E_USER_ERROR);
				}
			/*bind los resultados*/
			$query->bind_param('i', $this->id_usuario);
			/*ejecutar query*/
			$query->execute();
			/*bind los resultados*/
			$query->bind_result($user, $pass, $name, $mail);
			/*fetch datos*/
			$query->fetch();
			/*datos de la unidad*/
			$this->usuario = $user;
			$this->password = $pass;
			$this->nombre_usuario = $name;
			$this->email = $mail;
			
			/*cerrar conexiones*/
			$query->close();
			$this->db->close();
			}
		}
		
	/*traer el usuario*/
	public function getUsuario(){
		return $this->usuario;
		}
	/*traer la contraseña del usuario*/
	public function getPassword(){
		return $this->password;
		}
	/*traer el nombre del usuario*/
	public function getUserName(){
		return $this->nombre_usuario;
		}
	/*traer el email del usuario*/
	public function getEmail(){
		return $this->email;
		}
	/*funcion para comprobar si el password uno es igual el password dos*/
	public static function  comprobarPasswords($pass_uno, $pass_dos){
		/*si el password uno es el igual al dos regresar true*/
		if($pass_uno == $pass_dos){
			return true;
			}else{
				/*de lo contrario regresar false*/
				return false;
				}
		}
	/*funcion para generar un password aleatorio*/
	private static function generarHas(){
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUWYZX@#$%*<>\/][{}';
		$string = '';    
		$length = 50;
		
		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters))];
		}
      	return $string;
		}
	}
?>