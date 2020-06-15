# Requerimientos del proyecto

Se solicita la creación de un sitio web

## Creacion y diseño de base de datos

Diseño de base de datos 'posts' a partir de los requerimientos solicitados.  

<img src="/img/db.png" alt="db table" width="200"/> 

## Conexión a base de datos

Se crea archivo con nombre connection.php en el cual se instancia un objeto mysqli para su posterior importación e utilización en los archivos que requieran una conexión a la base de datos.


```php
<?php
    $servername = 'localhost';
    $username = 'fromiti';
    $password = 'admin';
    $database = 'posts';
    $conn = new mysqli($servername, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }else{
        session_start();
    }
```


