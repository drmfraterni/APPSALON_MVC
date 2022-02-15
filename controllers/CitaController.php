<?php

namespace Controllers;

use MVC\Router;

class CitaController {

    public static function index (Router $router)
    {
        //session_start();
        

        /** Datos a las vista */
        $datos = [
            'nombre'   =>  $_SESSION['nombre'],
            'id'   =>  $_SESSION['id'],
        ];
        $router->render('cita/index', $datos);
    }

}