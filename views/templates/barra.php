<?php 
    if (!empty($nombre)) {
        echo "<div class='barra'>";
        echo "<p>Hola: ${nombre}</p>";
        echo "<a href='/logout' class='boton'>Cerrar Sesión</a>";
        echo "</div>";        
    }  
?>