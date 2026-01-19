<?php
session_start();
if(!empty($_SESSION['id-usuario']) and isset($_SESSION['login']) and $_SESSION['login'] == true){
	session_unset();
	session_destroy();
	header("LOCATION: .");
	}else{
		header("LOCATION: .");
		}
?>