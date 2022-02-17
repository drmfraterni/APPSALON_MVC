# APPSALON_MVC
## RESUMEN:
Sitio web creado con PHP, Javascript, Mysql, css (grid y flexbox) 
Sirve de plantilla para otros proyectos
## CREANDO UN PROYECTO

1. ESTRUCTURA INCIAL
~~~
controllers
includes
|- app.php 
|- database.php
|- funciones.php
models
public
src
views
gulpfile.js
package.json
Router.php
~~~

* El archivo app contiene:
	enlace a funciones.php
	enlace a databases.php
	enlace al autoload de vendor
	enlace al ActiveRecord.php

1. Paso virtualhost

Hay que llevar el virtual vos a que arranque a la carpeta public
Ejemplo: https://www.appsalon.test/public

2.  Paso. Instalamos las dependencia de npm
En la consola o terminar ponemos: $ npm install

3. Paso. Activamos gulp
En la consola o terminar ponemos: $ gulp

4. Paso Activar composer.json
En la consola o terminar ponemos: $ composer init

5. Paso. Configurar composer.json

~~~
Package name (<vendor>/<name>) [roble/app-salon]:
Description []: Proyecto PHP, MVC, SQL, SASS, Gulp
Author [david <micorreo@gmail.com>, n to skip]:
Minimum Stability []:
Package Type (e.g. library, project, metapackage, composer-plugin) []: project
License []:
~~~
Define your dependencies.

Would you like to define your dependencies (require) interactively [yes]? no
Would you like to define your dev dependencies (require-dev) interactively [yes]? no
Add PSR-4 autoload mapping? Maps namespace "Roble\AppSalon" to the entered relative path. [src/, n to skip]: no
~~~
{
    "name": "roble/app-salon",
    "description": "Proyecto PHP, MVC, SQL, SASS, Gulp",
    "type": "project",
    "authors": [
        {
            "name": "robledomorante",
            "email": "drmfraterni@gmail.com"
        }
    ],
    "require": {}
}
~~~

Do you confirm generation [yes]? yes

6. Paso. Ahora abrimos el nuevo archivo generado composer.json
Configuramos el autoload automático de composer.json
~~~
{
    "name": "roble/app-salon",
    "description": "Proyecto PHP, MVC, SQL, SASS, Gulp",
    "type": "project",
    "autoload": {
        "psr-4": {
            "MVC\\" : "./",
            "Controllers\\" : "./controllers",
            "Model\\" : "./models"
        }
    },
    "authors": [
        {
            "name": "david",
            "email": "micorreo@gmail.com"
        }
    ],
    "require": {}
}
~~~
7. Paso. Actualizamos el composer.
~~~
En la consola o terminar ponemos: $ composer update
~~~

## MEDIAS QUERIES

1. Dispositivos pequeños landscapes teléfonos
@media (min-width:576px){ 
}
2. Dispositivos medianos tables
@media (min-width:768px){
}
3. Dispositivos grandes ordenadores, portátiles
@media (min-width:992px){
}

4. Dispositivos muy grandes ordenadores*/
@media (min-width:1200px){
}