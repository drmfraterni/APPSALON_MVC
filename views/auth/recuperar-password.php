<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Coloca tu nuevo password a continuación</p>

<?php  include_once __DIR__ . '/../templates/alertas.php';   ?>

<?php  if($error) return;   ?>
<form method="POST" class="formulario" >
    <div class="campo">
        <label for="password">Password</label>
        <input 
            type="password" 
            name="password" 
            placeholder="Tu nuevo Password" 
            id="password"
        />
    </div>
    <input type="submit" value="Guardar nuevo Password" class="boton">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta?. Inicia Sesión</a>
    <a href="/crear-cuenta">¿Aún no tines una cuenta?. Crear una</a>
</div>
