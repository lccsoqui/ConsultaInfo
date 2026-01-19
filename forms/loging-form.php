<div class="login">
    <div class="login-cont">
        <div class="login-header">
            <img src="images/logo.png" />
            <h1>Consulta Información</h1>
        </div>
        <div class="login-body">
            <h2>Iniciar sesión</h2>
            <div class="error-login">
                <?php 
                if(!empty($_GET) and isset($_GET['login'])){
                    echo '<div class="error-message">' . $mensaje['1005'] . '</div>';
                }
                if(!empty($_GET) and isset($_GET['session'])){
                    echo '<div class="error-message">Tu sesión ha expirado. Por favor, inicia sesión nuevamente.</div>';
                }
                ?>
            </div>
            <form name="login-form" id="login-form" method="post" action="login.php">
                <div class="input-group">
                    <input type="text" name="nombre-usuario" id="nombre-usuario" placeholder="Usuario" required spellcheck="false">
                    <span class="input-icon">👤</span>
                </div>
                <div class="input-group">
                    <input type="password" name="password-usuario" id="password-usuario" placeholder="Contraseña" required spellcheck="false">
                    <span class="input-icon">🔒</span>
                </div>
                <input type="submit" name="enviar-formulario" id="enviar-formulario" class="btn-login" value="Iniciar sesión">
            </form>
        </div>
    </div>
</div>