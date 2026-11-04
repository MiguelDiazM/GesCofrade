<?php

$_host = "localhost";
$_bd = "gescofrade";
$_usuario = "root";
$_contrasenia = "";

// Cualquier excepción no capturada se registra en el log de PHP y el usuario solo ve un mensaje genérico
set_exception_handler(function ($e) {
    error_log($e);
    http_response_code(500);
    echo "Se ha producido un error inesperado. Inténtalo de nuevo más tarde.";
});

try {
    $_conexion = new PDO("mysql:host=$_host;dbname=$_bd;charset=utf8", $_usuario, $_contrasenia);
    $_conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    error_log($e->getMessage());
    die("ERROR: No se puede conectar a la BBDD");
}
