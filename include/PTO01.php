<?php
session_start();
require('../funciones/query.class.inc.php');
require("../sources/msg-file.php");
require('../funciones/config.php');
include("../config/conn.php");

if(empty($_SESSION['id-usuario']) or !isset($_SESSION['login']) or $_SESSION['login'] != true){
	session_destroy();
	header("LOCATION: ../index.php?session=false");
	}

	echo  "<div class=\"info\" id=\"lista-contratos\"><center>Favor de elegir algún</center></div>";
	

?>
