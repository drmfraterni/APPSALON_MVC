<?php

namespace Controllers;

use Classes\Email;
use MVC\Router;
use Model\Usuario;

class LoginController
{
    public static function login(Router $router)
    {
        $alertas = [];
        $auth = new Usuario;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();

            if (empty($alertas)) {
                //comprobar que exista el usuario

                $usuario = Usuario::where('email', $auth->email);
                if($usuario) {
                    // verficar el password
                    if ($usuario->comprobarPasswordAndVerificado($auth->password)) {
                        // Autenticar el usuario
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        // Redireccionamiento dependiendo si es administrador o no

                        if ($usuario->admin === '1') {
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        } else {
                            header('Location: /cita');
                        }
                    }
                                    
                } else {
                    Usuario::setAlerta('error', 'Usuario no encontrado');
                }
            }


        }

        /** Datos a las vista */

        $alertas = Usuario::getAlertas();

        $datos = [
            'alertas'  =>  $alertas,
            'auth'     =>  $auth,
            
        ];

        $router->render('auth/login', $datos);
    }

    public static function logout()
    {
        echo 'desde logout';
    }

    public static function olvide(Router $router)
    {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            if (empty($alertas)) {
                $usuario = Usuario::where('email', $auth->email);
                if ($usuario && $usuario->confirmado === "1"){
                    /** GENERAR UN TOKEN ÚNICO */
                    $usuario->crearToken();
                    /** Crear Usuario en al BD */
                    $resultado = $usuario->guardar();
                    /** Enviar email con el token */
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();
                    // Alerta de exito
                    Usuario::setAlerta('exit', 'Revisa tu email');   
                } else {
                    Usuario::setAlerta('error', 'El usuario no existe o no está confirmado ');
                    
                }

            }

        }

        $alertas = Usuario::getAlertas();

        /** Datos a las vista */
        $datos = [
            'alertas'  =>  $alertas,
            
        ];
        $router->render('auth/olvide-password', $datos);
    }

    public static function recuperar(Router $router)
    {
        $alertas = [];
        $error = false;

        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            Usuario::setAlerta('error', 'Token no válido');
            $error = true;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $password = new Usuario($_POST);            
            $alertas = $password->validarPassword();

            if (empty($alertas)) {
                // Eliminamos el password antiguo
                $usuario->password = null;
                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = null;
                $resultado = $usuario->guardar();
                if($resultado) {
                    header('Location: /');
                }               

            }

        }
        
        /** Datos a las vista */
        $datos = [
            'alertas'  =>  $alertas,
            'error'    =>  $error,
        ];

        $router->render('auth/recuperar-password', $datos);
    }

    public static function crear(Router $router)
    {
        $usuario = new Usuario;

        // Alertas vacías
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // validar el id
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            // REVISAR QUE ALERTAS ESTE VACÍO

            if (empty($alertas)) {
                /** Ver que el usuario no está registardo */
                $resultado = $usuario->existeUsuario();

                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    /** HASHEAR el Password */ 
                    $usuario->hashPassword();
                    /** GENERAR UN TOKEN ÚNICO */
                    $usuario->crearToken();
                    /** Enviar email con el token */
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();
                    /** Crear Usuario en al BD */
                    $resultado = $usuario->guardar();

                    if ($resultado) {
                        header('Location: /mensaje');
                    }


                }
            }

        }

        /** Datos a las vista */
        $datos = [   
            'usuario'   => $usuario,
            'alertas'   => $alertas,

        ];
        $router->render('auth/crear-cuenta', $datos);
    }

    public static function mensaje(Router $router)
    {
        $datos = [];
        $router->render('auth/mensaje', $datos);
    }

    public static function confirmar(Router $router)
    {
        $alertas = [];
        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);
        if(empty($usuario)){
            // Mostrar mensaje de error
            Usuario::setAlerta('error', 'Token no válido');
            
        } else {
            // Poner el usuario a confirmado
            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta comprobado correctamente');
        }

        $alertas = Usuario::getAlertas();
        $datos = [
            'alertas'   =>  $alertas,
        ];
        $router->render('auth/confirmar-cuenta', $datos);
    }
}


