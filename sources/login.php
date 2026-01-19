<?php
require("config/conn.php");
require("funciones/login.class.inc.php");

/*cehcar si es post*/
if(!empty($_POST)){
	/*crear el objeto usuario login*/
	$usuario = new login($conn);
	/*recibir los datos*/
	$email = $_POST['nombre-usuario'];
	$pass = $_POST['password-usuario'];
	
	/*comprobar que no vemngan vacios*/
	if(empty($email) and strlen($email) > 0){
		header("LOCATION: index.php?login=false");
		exit();
		}
	
		/*checar que sea un mail valido*/
	/*
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		header("LOCATION: index.php?login=false");
		exit();
		}
	*/	
	/*comprobar que venga la contrase;a*/
	if(empty($pass) and strlen($pass) > 0){
		header("LOCATION: index.php?login=false");
		exit();
		}
	
	/*acer login*/	
	$login = $usuario->loging($email, $pass);
	/*comprobar el login*/
	if($login == 1){
		session_start();
		session_name('pi-login');
		$_SESSION['id-usuario'] = $usuario->getIdUsuario();
		$_SESSION['nombre-usuario'] = $usuario->getNombreUsuario();
		$_SESSION['nivel-usuario'] = $usuario->getNivel();
		$_SESSION['rol'] = $usuario->getRol();
		$_SESSION['login'] = true;
		header("LOCATION: home/");
		}else{
			header("LOCATION: index.php?login=false");
			}
	}
?>