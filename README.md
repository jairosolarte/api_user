
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

+--------+-----------+-----------------+--------------+----------------------------------------------+------------+
| Domain | Method    | URI             | Name         | Action                                       | Middleware |
+--------+-----------+-----------------+--------------+----------------------------------------------+------------+
|        | GET|HEAD  | /               |              | Closure                                      | web        |
|        | GET|HEAD  | api/user        | user.index   | App\Http\Controllers\UsersController@index   | api        |
|        | POST      | api/user        | user.store   | App\Http\Controllers\UsersController@store   | api        |
|        | DELETE    | api/user/{user} | user.destroy | App\Http\Controllers\UsersController@destroy | api        |
|        | GET|HEAD  | api/user/{user} | user.show    | App\Http\Controllers\UsersController@show    | api        |
|        | PUT|PATCH | api/user/{user} | user.update  | App\Http\Controllers\UsersController@update  | api        |
+--------+-----------+-----------------+--------------+----------------------------------------------+------------+