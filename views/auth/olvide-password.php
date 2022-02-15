<h1 class="nombre-pagina">Olvide Password</h1>
<p class="descripcion-pagina">Restablece tu Password escribiendo tu email a continuación</p>

<?php  include_once __DIR__ . '/../templates/alertas.php';   ?>
<form method="POST" class="formulario" action="/olvide">
    <div class="campo">
        <label for="email">E-mail</label>
        <input 
            type="email" 
            name="email" 
            placeholder="Tu Email" 
            id="email"
        />
    </div>
    <input type="submit" value="Enviar las instrucciones" class="boton">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta?. Inicia Sesión</a>
    <a href="/crear-cuenta">¿Aún no tines una cuenta?. Crear una</a>
</div>
