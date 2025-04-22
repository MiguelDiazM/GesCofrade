<?php
    // Config pa la conexion con la bd
    $_host = "localhost";
    $_bd = "gescofrade";
    $_usuario = "root";
    $_contrasenia = "";

    // Crear la conexion usando PDO (PHP Data Object)
    try {
        // Creamos objeto PDO pq este incluye info para interactuar con la bbdd y realizar consultas, inserciones...
        $_conexion = new PDO("mysql:host=$_host;dbname=$_bd;charset=utf8", $_usuario, $_contrasenia);

        // Configurar PDO para lanzar excepciones en caso de haber un error
        $_conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die ("ERROR: No se puede conectar a la BBDD -> " . $e->getMessage());

    }
?>