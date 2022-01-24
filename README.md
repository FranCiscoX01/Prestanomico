# Prestanomico
Este projecto es para ejecutarse de forma local, por recomendación es bueno asegurarse que tenga las herramientas adecuadas para su instalación como puede ser un servidor apache como XAMP o WAMP
para ejecución de PHP, también tener instalado composer, así como tener instalado Nodejs.

*Crear la base de datos en el servidor local
La base de datos debe de tener el nombre de "prestanomico"

*Colocarse en el directorio de PruebaDev

<code>cd PruebaDev/</code>


*Ejecutar el comando 

<code>npm install</code>
<code>composer install</code>

*Posteriormente ejecutar los siguientes comandos
<code>php artisan migrate</code> ... Nos ayudara a ejecutar las migraciones a la base datos

*El siguiente comando nos ayudara a generar usuarios que se utilizaran para el token con la api
<code>php artisan passport:install</code>

*Creamos un usuario falso
<code>php artisan tinker</code>
<code>factory('App\User')->create()</code>


*Abriremos el servidor para ejecutar la aplicacion
<code>php artisan serve</code>
