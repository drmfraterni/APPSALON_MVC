<?php

namespace Controllers;

use Model\Cita;
use Model\Servicio;

//use MVC\Router;

class APIController {

    public static function index ()
    {
        /**
         * Montando la API DE SERVICIOS
         */
        $servicios = Servicio::all();
        echo json_encode($servicios);
       
    }

    public static function guardar() {
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();
        echo json_encode($resultado);
    }

}