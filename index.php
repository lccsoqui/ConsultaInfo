<?php
session_start();
require("sources/msg-file.php");
if(!empty($_SESSION['id-usuario']) and isset($_SESSION['login']) and $_SESSION['login'] == true){
	header("LOCATION: home/");
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="logo2.ico">
<title>Consulta Registro Civil</title>
<link type="text/css" rel="stylesheet" href="css/estilo.css">
</head>

<body>
<?php 
include("forms/loging-form.php");
?>
</body>
</html>