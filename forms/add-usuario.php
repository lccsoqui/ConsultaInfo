<?php
session_start();
require('../funciones/query.class.inc.php');

if($_SESSION['login'] != true){
	exit;
	}
/*crear nuevo objeto query*/
$query = new querys();
/*lista de clientes*/
$clientes = $query->traerMultiplesResultados('SELECT `ID`, `NOMBRE` FROM `clientes` ORDER BY NOMBRE', NULL);
?>
<div id="resultado"></div>
<form name="agregar-nuevo-usuario" id="agregar-nuevo-usuario" method="post">
	<table width="100%" cellpadding="5" cellspacing="0" border="0" id="table-form-nuevo-usuario">
    	<caption class="form-caption">Agregar nuevo usuario</caption>
    	<tbody valign="top">
        	<tr>
            	<td><label>Cliente</label></td>
                <td><select name="cliente" id="cliente" required>
                <option value="">--Seleccione--</option>
                <?php
				foreach($clientes as $cliente){
					echo "<option value=\"".$cliente['ID']."\">".$cliente['NOMBRE']."</option>";
					}
				?>
                </select></td>
            </tr>
        	<tr>
            	<td><label for="usuario">Usuario</label></td>
                <td></td>
            </tr>
            <tr>
            	<td><input type="text" name="usuario" id="usuario" placeholder="@email" required></td>
                <td></td>
            </tr>
            <tr>
            	<td><label for="">Contraseña</label></td>
                <td><label>Re-contraseña</label></td>
            </tr>
            <tr>
            	<td><input type="password" name="password_uno" id="password_uno" required></td>
                <td><input type="password" name="repassword_dos" id="repassword_dos" required></td>
            </tr>
            <tr>
            	<td><label>Nombre del usuario</label></td>
                <td><label>Correo electrónico</label></td>
            </tr>
            <tr>
            	<td><input type="text" name="nombre-usuario" id="nombre-usuario" size="45" required></td>
                <td><input type="email" name="email-usuario" id="email-usuario" required></td>
            </tr>
            <tr>
            	<td class="content-form-buttons">
                	<input type="submit" name="enviar-formulario" id="enviar-formulario" value="Guardar" class="btn-green">
                    <input type="button" name="cancelar-formulario" id="cancelar-formulario" value="Cancelar" class="btn">
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>
</form>
<script type="text/javascript">
$(document).on("submit", "#agregar-nuevo-usuario", function(){
	var datos = $(this).serialize();
	$.ajax({
		beforeSend: function(){
			$("#resultado").html("Cargado....");
			$("#enviar-formulario").prop("disabled", true);
			},
		url:"../sources/insert/crear-usuario.php?rand=" + Math.random() * 9999999,
		type:"POST",
		data: datos,
		error: function(jqXHR, textStatus, errorThrown){
			$("#resultado").html(jqXHR.responseText);
			},
		success: function(resultados){
			$("#resultado").html(resultados);
			},
		complete: function(){
			$("#enviar-formulario").prop("disabled", false);
			},
		});
	
	return false;
	});
</script>