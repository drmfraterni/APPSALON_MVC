<?php

namespace MVC;

class Router
{

    public $rutasGET = [];
    public $rutasPOST = [];


    public function get($url, $fn) {

        $this->rutasGET[$url] = $fn;

    }

    public function post($url, $fn) {

        $this->rutasPOST[$url] = $fn;

    }
    
    public function comprobarRutas()
    {    
        // cargar la sesión activa en caso que lo esté
        session_start();
        $auth = $_SESSION['login'] ?? null;

        // Arreglo de rutas protegidas

        /*$rutas_protegidas = [
            '/admin', 
            '/propiedades/actualizar',
            '/propiedades/crear',
            '/propiedades/eliminar',
            '/vendedores/crear',
            '/vendedores/actualizar',
            '/vendedores/listarPropiedades',
            '/vendedores/eliminar',
        ];*/
        
        if (!isset($_GET['url']) ) {
            $_GET['url'] = '';

        }
 

        //$urlActual = $_SERVER['PATH_INFO'] ?? '/';

        $urlPrueba = self::separaURL();

        $this->controlador = $urlPrueba[0];        
        unset($urlPrueba[0]);
        $this->urlBuena = '/'.$this->controlador;

        if (isset($urlPrueba[1])){
            $this->propiedad = $urlPrueba[1];
            unset($urlPrueba[1]);
            $this->urlBuena = '/'.$this->controlador.'/'.$this->propiedad;            
        }

        
          
        //$urlActual = explode('?', $_SERVER['REQUEST_URI'], 2) ?? '/';
        $urlActual = $this->urlBuena;
        $metodo = $_SERVER['REQUEST_METHOD'];


        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null; 
                 
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null; 
        }

        // proteger las rutas
        /*if (in_array($urlActual, $rutas_protegidas) && !$auth) {

            header('Location: /');
        }*/


        if ($fn) {

            // La URL existe y hay una función asociada
            // llamamos a una función que no sabemos como se llama
            call_user_func($fn, $this);
        } else {
            echo "Página No Encontrada";
        }       

    }

    // Mostrar las vistas

    public function render($view, $datos=[]) {

        foreach ($datos as $key => $value) {
            $$key = $value;
        }
        // Doble signo de dolar significa: variable variable, básicamente nuestra variable sigue siendo la original, 
        // pero al asignarla a otra no la reescribe, mantiene su valor, 
        // de esta forma el nombre de la variable se asigna dinamicamente

        // Guardar datos en memoria
        ob_start();
        include_once __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();
        // patrón de vista con la cabecera y el pie de página
        include_once __DIR__ . "/views/layout.php";

    }

    static public function separaURL()
    {
        $url = "";

        /**
         * la url viene del archivo .htaccess
         */ 
        if (isset($_GET['url'])) {

            //var_dump($_GET['url']);
            

            // Limpiamos la url de caracteres 

            // limpiamos la diagonal de la url
            $url = rtrim($_GET['url'], '/'); 
            $url = rtrim($_GET['url'], '\\');


            // limpiamos caracteres no propios para la URL
            $url = filter_var($url, FILTER_SANITIZE_URL);


            // Separamos en un array

            $url = explode('/', $url);

            return $url;            
        }
    }
}