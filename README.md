<p align="center">
    <img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>
    <p align="center">Keiron Test</p>

## Prerrequisitos


Se debe instalar el siguiente software antes de continuar con los siguientes pasos

```
- PHP 7.2.* >=
- Mysql 10.4
```

## Pasos para probar el desarrollo

Se debe seguir los siguientes pasos para que el proyecto funcione correctamente:

Ingresar a MySql: 
```
- Mysql -u root -p
```


Crear una base de datos con el nombre "ticket_crud" y salir de MySql: 
```
- create database ticket_crud;
- exit
```


Clonar proyecto: 
```
- git clone https://github.com/jovicon/Keiron.git
```


Ir a carpeta del proyecto: 
```
- cd Keiron/
```


Instalar requerimientos de composer: 
```
- php composer.phar install
```


Copiar archivo env.example a .env: 
```
- cp .env.example .env
```


Editar documento .env con las credenciales para la base de datos: 
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE="ticket_crud"
DB_USERNAME="user"
DB_PASSWORD="password"
```


Generar nueva llave del proyecto
``` 
- php artisan key:generate
```


Correr migraciones de la base de datos
```
- php artisan migrate
```


Correr semillas para la base de datos <br>
Nota: Esta semilla inserta los tipos de perfiles ademas de un usuario para cada perfil.  
Para mas detalles revisar archivo database/seeds/user_type_data.php 
```
- php artisan db:seed --class=user_type_data
```


Correr servidor web php para desarrollo
```
- php artisan serve --port=80
```

Ingresar a http://127.0.0.1/register
