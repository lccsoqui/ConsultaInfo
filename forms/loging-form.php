<div class="login">
    <div class="login-cont">
    <img src="images/logo_RC_Header.png" />
    <h1><center>Consulta Registro Civil</center></h1>
    	<h2>Iniciar sesión</h2>
        <div class="error-login">
        	<?php 
			if(!empty($_GET) and isset($_GET['login'])){
				echo $mensaje['1005'];
				}
			?>
        </div>
        <form name="login-form" id="login-form" method="post" action="login.php">
            <input type="text" name="nombre-usuario" id="nombre-usuario" placeholder="Usuario" required spellcheck="false">
            <input type="password" name="password-usuario" id="password-usuario" placeholder="Contraseña" required spellcheck="false">
            <input type="submit" name="enviar-formulario" id="enviar-formulario" class="btn btn-green" value="Iniciar sesión">
        </form>
        
    </div>
</div>