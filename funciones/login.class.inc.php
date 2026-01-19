<?php 

class login{
	
	var $db;//conexcion a la base de datos
	private $usuario;//nombre del usuario
	private $email;//email del usuario (que tambien va a ser el usuario de login)
	private $id_usuario;//id asignado al usuario
	private $nombre_usuario;//nombre del usuario real nombre

	
	/*constructor*/
	function __construct($connSI, $id = NULL){
		$this->db = $connSI;//conexion a la base de datos
		}
		
	/*metodo de login*/
	public function loging($usuario, $password){
		/*query*/
		$sql_query = "SELECT IdUsuario, Login, Nombre, Pass FROM `usuariosrc` U 
	        wHERE U.Login = ?;";
		/*preparar el query*/
		$query = $this->db->prepare($sql_query);
		/*comprobar el query*/
		if($query === false){
			trigger_error('Ocurrio un problema con el query: ' . $sql_query . ' Error: ' . $this->db->error, E_USER_ERROR);
			}
		/*bind parametros*/
		$query->bind_param('s', $usuario);
		/*ejecutar query*/
		$query->execute();
		/*guardar los datos*/
		$query->store_result();
		/*bind los resultados*/
		$query->bind_result($id_usuario, $usuario, $nombre_usuario, $pass);
		/*fetch datos*/
		$query->fetch();
			/*comprobar que aya arrojado resultados*/
			if($query->num_rows == 1){
				/*comprobar fuerza bruta*/
			
					/*hash el password*/
					/* $password = hash('sha512', $password.$salt);*/
					
					/*comprobar que el password de la db coicida con el introducido*/
					if($password == $pass){
						/*varibles del usuario*/
						$this->id_usuario = $id_usuario;
						$this->nombre_usuario = $nombre_usuario;

						
						/*regresar true*/
						return true;
						}else{
							
							return false;
							}
					
				}else{
					return false;
					}
		/*cerrar el query*/
		$query->close();
		}
	

	/*get el id del usuario*/
	public function getIdUsuario(){
		return $this->id_usuario;
		}
	/*get el id del cliente*/
	public function getIdCliente(){
		return $this->id_cliente;
		}
	/*get el nombre del usuario*/
	public function getNombreUsuario(){
		return $this->nombre_usuario;
		}

	}
?>