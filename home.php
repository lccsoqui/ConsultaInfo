<?php
session_start();
require("config/conn.php");
require('funciones/config.php');


if(empty($_SESSION['id-usuario']) or !isset($_SESSION['login']) or $_SESSION['login'] != true){
	session_destroy();
	header("LOCATION: ../index.php?session=false");
	}
/*DEFINIR EL ROOT*/
define('URL', 'home/');

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<base href="http://172.16.31.132:99/consultaregistro/">
<title>Consulta Registro Civil</title>
<link rel="shortcut icon" href="logo2.ico">
<meta http-equiv='cache-control' content='no-cache'>
<meta http-equiv='expires' content='0'>
<meta http-equiv='pragma' content='no-cache'>
<link type="text/css" rel="stylesheet" href="css/newestilo.css">
<link type="text/css" rel="stylesheet" href="css/fuentes.css">
<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/vitrum.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.11.3/css/select.dataTables.min.css">

    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

</head>
<body>
<div class="contenedor">
    <header>
        <div class="logo-span">
            <a href="home/"><img src="images/logo.png" id="logo" title="Consulta Registro Civil" alt="logo"></a>
        </div>
       
        <div class="logo-span">
        <h2 style="display:inline-block;">Consulta defunciones en Registro Civil</h2>
        </div>

        <div class="header-opciones-usuario">
            <ul id="menu-opciones">
                        
                <li><a href="logout.php" class="icon-fontawesome-webfont-9">Salir</a></li>
            </ul>
        </div>
    </header>

    <div class="contenedor-opciones">
        <div class="contenedor-opciones-inner">
        	<div class="content-op">
            	<ul class="opciones-listas opciones">
                	<li><input type ="hidden" name="tipo-opcion" id="tipo-opcion-new" value = "1">
                    </li>
                </ul>
                
            </div>
            <footer>
                <div class="fix">
                </div>
            </footer>
        </div>
    </div>

    <div class="contenedor-datos">
        <div id="loading-screen"><img src="images/loading.gif"></div>
        <div class="contenedor-datos-inner">
            <div class="contenedor-datos-titulos" id="titulos">
                <div class="content-buscar">
                	<form name="buscador-form" id="buscador-form" method="post">
                    
                        <div  id="contenedor-advance-search">
                        <table width="100%;">
                        <tr>
                            <td><label>Nombre</label></td>
                            <td><input type="text" name="Nombre" id="Nombre" style="width:80%;">
                            
                            </select></td>
                        </tr>

                        <tr >
                            <td><label>Apellido paterno</label></td>
                            <td><input type="text" name="Paterno" id="Paterno" style="width:80%;">
                            
                            </select></td>
                        </tr>

                        <tr >
                            <td><label>Apellido materno</label></td>
                            <td><input type="text" name="Materno" id="Materno" style="width:80%;">
                            
                            </select></td>
                        </tr>

                        <tr >
                            <td><label>CURP</label></td>
                            <td><input type="text" name="Curp" id="Curp" style="width:80%;">
                            
                            </select></td>
                        </tr>

                        <tr>
                        <td colspan="2"><button  type="submit" name="enviar-formulario" id="enviar-form-buscar" class="btn btn-green btn-block" value="Buscar">Buscar</button></td>
                            </tr>
                        </table>
                        </div>
                    </form>
                    
                    <div class="return-contratos" style="display:none; line-height:40px; font-size:14px;">
                    </div>
            </div>
            <div class="contenedor-datos-datos toggle-content" id="contenedor-datos">
            </div>
           
        </div>
    </div>
</div>
</body>

</html>
