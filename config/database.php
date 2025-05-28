<?php
// Config pa la conexion con la bd
$_host = "localhost";
$_bd = "gescofrade";
$_usuario = "root";
$_contrasenia = "";


try {
    $_conexion = new PDO("mysql:host=$_host;dbname=$_bd;charset=utf8", $_usuario, $_contrasenia);
    $_conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    die("ERROR: No se puede conectar a la BBDD -> " . $e->getMessage());
}
