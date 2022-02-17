<?php

namespace Controllers;

use Model\Cita;
use Model\Servicio;
use MVC\Router;

//use MVC\Router;

class AdminController {

    public static function index ( Router $router)
    {
        session_start();
        isAuth();        
        $datos = [
            'nombre'  =>  $_SESSION['nombre'],
        ];
        $router->render('admin/index', $datos);
        

    }


}