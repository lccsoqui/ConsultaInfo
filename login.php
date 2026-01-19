<?php
require("config/conn.php");

/*cehcar si es post*/
if(!empty($_POST)){
	
	/*recibir los datos*/
	$email = $_POST['nombre-usuario'];
	$pass = $_POST['password-usuario'];
	
	/*comprobar que no vemngan vacios*/
	if(empty($email) and strlen($email) > 0){
		header("LOCATION: index.php?login=false");
		exit();
		}
		
	/*comprobar que venga la contrase;a*/
	if(empty($pass) and strlen($pass) > 0){
		header("LOCATION: index.php?login=false");
		exit();
		}
	
	$callSP = "select IdUsuario, Login, Nombre, Pass FROM usuariosrc U 
	wHERE U.Login = ? and Pass = ?";
	$myparams['u'] = $email;
	$myparams['p'] = $pass;

	$params = array(
		  array($myparams['u'], SQLSRV_PARAM_IN),
		  array($myparams['p'], SQLSRV_PARAM_IN),
		  );
		 
	$stmt = sqlsrv_query($connSI, $callSP, $params);
	if( $stmt === false )
	{
		echo "Error in executing statement 3.\n";
		die( print_r( sqlsrv_errors(), true));
	}
	session_start();
	while ($row=sqlsrv_fetch_array($stmt)) {
		/*comprobar el login*/
		$login = 1;
		$_SESSION['id-usuario'] = $row['IdUsuario'];
		$_SESSION['nombre-usuario'] = $row['Nombre'];
		
	}

	if($login == 1){

		
		session_name('pi-login');
		$_SESSION['login'] = true;
		header("LOCATION: home/");
		}
		else{
			header("LOCATION: index.php?login=false");
		}


}
?>