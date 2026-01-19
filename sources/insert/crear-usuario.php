<?php
session_start();
require("../../config/conn.php");
require("../../funciones/usuarios.class.inc.php");
require("../../sources/msg-file.php");

/*crear un nuevo objeto usuario*/
$usuario = new usuario($conn, NULL);

if(!empty($_POST) and $_SESSION['login'] == true){
/*obtener los datos*/
$cliente = $_POST['cliente'];
$user = $_POST['usuario'];
$password = $_POST['password_uno'];
$repassword = $_POST['repassword_dos'];
$nombre = $_POST['nombre-usuario'];
$email = $_POST['email-usuario'];

	/*comprobar los campos requerdos*/
	if(empty($cliente)){
		echo "<div class=\"warning\">".$mensaje['1001']."</div>";
		exit();
		}
	/*comprobar los campos requerdos*/
	if(empty($user)){
		echo "<div class=\"warning\">".$mensaje['1001']."</div>";
		exit();
		}
	if(empty($password)){
		echo "<div class=\"warning\">".$mensaje['1001']."</div>";
		exit();
		}
	if(empty($repassword)){
		echo "<div class=\"warning\">".$mensaje['1001']."</div>";
		exit();
		}
	if(empty($nombre)){
		echo "<div class=\"warning\">".$mensaje['1001']."</div>";
		exit();
		}
	if(empty($email)){
		echo "<div class=\"warning\">".$mensaje['1001']."</div>";
		exit();
		}
	if(usuario::comprobarPasswords($password, $repassword) == false){
		echo "<div class=\"warning\">Las contraseñas no coinciden</div>";
		exit();
		}
		
	/*crear usuario*/
	if($usuario->crearUsuario($cliente, $user, $password, $nombre, $email) == true){
		echo "<div class=\"success\">".$mensaje['1002']."</div>";
		}
}
?>