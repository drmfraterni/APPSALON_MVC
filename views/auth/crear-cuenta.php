<h1 class="nombre-pagina">Crear una Cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>

<?php  include_once __DIR__ . '/../templates/alertas.php';   ?>
<form method="POST" class="formulario" action="/crear-cuenta">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input 
            type="text" 
            name="nombre" 
            placeholder="Tu nombre" 
            id="nombre"
            value="<?php echo s($usuario->nombre); ?>"
        />
    </div>
    <div class="campo">
        <label for="apellido">Apellido</label>
        <input 
            type="text" 
            name="apellido" 
            placeholder="Tu apellido" 
            id="apellido"
            value="<?php echo s($usuario->apellido); ?>"
        />
    </div>
    <div class="campo">
        <label for="telefono">Telefono</label>
        <input 
            type="tel" 
            name="telefono" 
            placeholder="Tu telefono" 
            id="telefono"
            value="<?php echo s($usuario->telefono); ?>"
        />
    </div>
    <div class="campo">
        <label for="email">E-mail</label>
        <input 
            type="email" 
            name="email" 
            placeholder="Tu Email" 
            id="email"
            value="<?php echo s($usuario->email); ?>"
        />
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input 
            type="password" 
            name="password" 
            placeholder="Tu Password" 
            id="password"
            value="<?php echo s($usuario->password); ?>"
        />
    </div>
    <input type="submit" value="Iniciar Sesión" class="boton">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta?. Inicia Sesión</a>
    <a href="/olvide">Olvidaste Password</a>
</div>
