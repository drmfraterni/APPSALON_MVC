<?php

    foreach ($alertas as $key => $mensajes) {
        foreach ($mensajes as $mensaje) {
            echo "<div class='alerta ${key}'>"; 
            echo $mensaje;
            echo " </div>";
        }
    }


?>