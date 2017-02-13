
# [api_user](https://github.com/jairosolarte/api_user)

Para el siguiente proyecto se utilizara Laravel 5.3 ya que este framework facilita la sintaxis de los estándares PSR-2 (Coding Style Guide), PSR-4 (Autoloader) y para los logs PSR-3. Además Laravel trabaja con composer para la instalación del proyecto, migrater, CRUD, instalación de dependencias y en general se utilizara  composer para automatización de los proyectos. 


## GITHUB
[https://github.com/jairosolarte/api_user](https://github.com/jairosolarte/api_user)

## Tareas

Por tiempo el proyecto durara 8 días empezando desde lunes 6 de febrero y su entrega para el día 13 de febrero. El proyecto se subirá en github donde se podrá ver su avance diario que se basa en el siguiente cronograma. 

* Planeación.
* Creación de proyecto en github. 
* Instalación de framework. 
* Creación de base de datos (Artisan migration). 
* Creación controlador para el API (Composer). 
* Manejo de excepciones. 
* Creación de Logs. 
* Pruebas unitaria.
* Documentación. 
* Entrega. 

## Requerimientos  de instalación

Se utiliza para la implementación del API el Framework Laravel versión 5.3,  su documentación en la página oficial  https://laravel.com/docs/5.3.  Los requerimientos de framework son los siguientes.

* PHP >= 5.6.4
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension.


## Herramientas 

* Composer : Es un manejador de dependencias de php su pagina oficila https://getcomposer.org/
* Git: Es un software de control de versiones, su página oficial https://git-scm.com/.


## Instalación

0. clonar el repositorio 
```
git clone https://github.com/jairosolarte/api_user.git
```
nos muestra la siguiente estrucutura. En la carpeta laravel esta instalado el framework.

![imgg1](https://cloud.githubusercontent.com/assets/6656250/22868892/c0c6c836-f168-11e6-8153-dd3b76d8678c.JPG)

1. Ingresar a la carpeta de laravel
```
cd laravel
```
2. Dentro de la carpeta laravel se descarga los repositorios y librerias.
```
composer install
``` 
3. Configrar base de datos. 

    Para crear las tablas primero se configura en laravel los parametros de conexion  en el archivo de configuración de la base de datos de laravel que esta `/laravel/config/database.php`

```php
'mysql' => [
    'driver' => 'mysql',
    'host' => getenv('IP'),
    'port' => env('DB_PORT', '3306'),
    'database' => 'c9',
    'username' => getenv('C9_USER'),
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
    'strict' => true,
    'engine' => null,
],
```
4. Crear tablas : 

Lista la configuración y activado el servicio de mysql se continuar ejecutando los migrates para crear las tablas, los migrate están ubicados en `/laravel/database/migrations` y se ejecutan  con el comando.

```
php artisan migrate
``` 


5. Fin de la instalación. 

En el proyecto ya está creado el model User  que se ubica `/laravel/app/User.php` y el controlador donde está implementado el API `/laravel/app/Http/Controllers/UsersController.php`  
para poder ver los URLs implementadas o expuestas se utiliza el siguiente comando.

```
php artisan route:list
``` 
![captura2](https://cloud.githubusercontent.com/assets/6656250/22869416/dcd99b9e-f16c-11e6-8b67-7389d500f028.JPG)

### 

Los servicio se configuran en archivo api de la carpeta router de laravel `/laravel/routes/api.php` 
```php
Route::resource('user', 'UsersController',['only' => ['index', 'store', 'update', 'destroy', 'show']]);
Route::post('user/{id}/upload', 'UsersController@upload');
``` 
## Servicios

El servicio se implemento en un servidor php `http://apiuser.edulink.co`
```
Listado.
Método : GET
url: api/user
ejemplo: http://apiuser.edulink.co/api/user

Crear usuario.
Método : POST
url:api/user
ejemplo: http://apiuser.edulink.co/api/user

Obtener un usuarios específico.
Método : GET
url: api/user/{id} 
ejemplo: http://apiuser.edulink.co/api/user/60 

Actualizar un usuarios específico.
Método : PUT|PATCH
url: api/user/{id}  
ejemplo: http://apiuser.edulink.co/api/user/60  

Eliminar un usuarios específico.
Método : DELETE
url: api/user/{id} 
ejemplo:http://apiuser.edulink.co/api/user/60 
	
Cargar una Imagen a un usuario: 
Método: POST
url: api/user/{id}/upload
ejemplo: http://apiuser.edulink.co/api/user/60/upload 
``` 
## Pruebas Unitarias. 

Se realizan pruebas unitarias a los servicios y para que funciones se necesita los siguientes requerimiento.

* PHPUnit.
```
composer global require "phpunit/phpunit=5.5.*"
```
* code-coverage 
```
composer require phpunit/php-code-coverage 
```
* xdebug : para su instalación debes dirigirte a `https://xdebug.org/wizard.php`, seguir las intrucciones. 

Los archivos de pruebas unitarias se encuentran en `/laravel/tests` y el archivo que estan las pruebas unitarias del API  es `/laravel/tests/UserControllerTest.php`

El archivo de configuración de las pruebas unitarias esta `/laravel/phpunit.xml`. Se agrega la sigueinte linea.

```
<logging>
     <log type="coverage-html" target="public/unitTest" charset="UTF-8"/>
</logging>
```
En donde se le indica que la carpeta`/laravel/public/unitTest` estaran los archivos que genera la pruebas unitarias.

El siguiente comonado ejecuta las pruebas unitarias. 

```
phpunit
```

![captura](https://cloud.githubusercontent.com/assets/6656250/22870444/5bc4ed70-f175-11e6-81c2-7f88dbca5213.JPG)

Su resultado se lo observa en la siguiente pagina. http://apiuser.edulink.co/unitTest/

![captura3](https://cloud.githubusercontent.com/assets/6656250/22870521/f6bf71d8-f175-11e6-92aa-657603c9817d.JPG)

El que interesa en esta prueba es el cubrimiento de el archivo `UsersController.pho` en la siguiente pagina http://apiuser.edulink.co/unitTest/Http/Controllers/UsersController.php.html

![captura4](https://cloud.githubusercontent.com/assets/6656250/22870592/8267ad5e-f176-11e6-973c-9bf1811b6700.JPG)

Esta imagen muestra un cubrimiento del 100 % en los servicios menos en el serivicio de carga e Imgen donde por tiempo no se realizo prueba unitaria. 

## Logs. 

Laravel implementa Log segun el PSR-3 y los almacena `/laravel/storage/logs/laravel.log`

este es un ejemplo al correr las pruebas unitarias.
```
[2017-02-13 03:46:41] testing.ERROR: showUser {"id":"1234567890"}  
[2017-02-13 03:46:42] testing.DEBUG: createUser {"name":"Dr. Donavon Pouros II","email":"jairosolarte@ingenieros943.com","Image":"","id":257}  
[2017-02-13 03:46:42] testing.ERROR: createUser {"name":"Dr. Donavon Pouros II","email":""} ["The email field is required."]  
[2017-02-13 03:46:43] testing.DEBUG: updateUser {"id":258,"name":"Mr. Cody Skiles Jr.","email":"xavier.kilback@example.net","Image":"https:\/\/upload.wikimedia.org\/wikipedia\/commons\/3\/3d\/LaravelLogo.png"}  
[2017-02-13 03:46:44] testing.ERROR: updateUser {"name":"Mr. Cody Skiles Jr.","email":""} ["The email field is required."]  
[2017-02-13 03:46:44] testing.ERROR: updateUser {"id":"12345677"}  
[2017-02-13 03:46:45] testing.DEBUG: deleteUser {"id":259,"name":"Mr. Virgil Huel PhD","email":"ryan.adrain@example.com","Image":"https:\/\/upload.wikimedia.org\/wikipedia\/commons\/3\/3d\/LaravelLogo.png"}  
[2017-02-13 03:46:45] testing.ERROR: deleteUser {"id":"12345678"} 
```