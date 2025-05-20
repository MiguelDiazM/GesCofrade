<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require "../../config/database.php";

session_start();

if (isset($_SESSION["usuario"])) {
    header("Location: ../../public/index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tmp_nombre = $_POST["nombre"] ?? "";
    $tmp_contrasena = $_POST["contrasena"] ?? "";
    $tmp_city = $_POST["poblacion"] ?? "";
    $tmp_tipo = $_POST["tipo"] ?? "";

    $envioError = "../views/signup.php";

    if (empty($tmp_nombre)) {
        $err_nombre = "<span class='bg-warning'>El nombre no puede estar vacío</span>";
        $envioError .= "?err_nombre=$err_nombre";
    } else {
        $nombre = $tmp_nombre;
    }

    if (empty($tmp_contrasena)) {
        $err_contrasena = "<span class='bg-warning'>La contraseña no puede estar vacía</span>";
        $envioError .= "?err_contrasena=$err_contrasena?";
    } else {
        $contrasena = $tmp_contrasena;
    }

    if (empty($tmp_city)) {
        $err_city = "<span class='bg-warning'>Debes introducir una ciudad</span>";
        $envioError .= "?err_city=$err_city";
    } else {
        $city = $tmp_city;
    }

    if (empty($tmp_tipo)) {
        $err_tipo = "<span class='bg-warning' Debes introducir un tipo></span>";
        $envioError .= "?err_tipo=$err_tipo";
    } else {
        $tipo = $tmp_tipo;
    }

    if (isset($nombre) && isset($contrasena) && isset($city) && isset($tipo)) {
        //TODO: Se debe crear una hermandad con el nombre introducido y a partir de ella se crearan los usuarios
        $consulta = "INSERT INTO hermandad (id_hermandad, nombre, tipo, ubicacion) VALUES (:i,:n, :t, :u)";
        $stmt = $_conexion->prepare($consulta);
        $stmt->execute([
            ":i" => "SELECT max(id_hermandad) + 1 FROM hermandad",
            ":n" => $nombre,
            ":t" => $tipo,
            ":u" => $city
        ]);
        // Comprobamos si el usuario ya existe
        $consulta = "SELECT * FROM usuarios WHERE usuario = :n";
        $stmt = $_conexion->prepare($consulta);
        $stmt->execute([
            ":n" => $nombre
        ]);

        $nombre = explode(" ", $nombre);
        $poblacion = explode(" ", $city);

        $usuario = implode("_", $nombre) . "_" . implode("_", $poblacion);
        $nombre = implode(" ", $nombre);
        if ($stmt->rowCount() === 0) {
            $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
            $insert = "INSERT INTO usuarios (usuario, contrasena, id_hermandad) SELECT :usuario, :contrasena, id_hermandad FROM hermandad WHERE nombre = :nombre";
            $stmt_insert = $_conexion->prepare($insert);
            $stmt_insert->execute([
                ":usuario" => $usuario,
                ":contrasena" => $contrasena_hash,
                ":nombre" => $nombre
            ]);
            header("Location: ../../public/index.php");
        } else {
            $err_nombre = "<span class='bg-warning'>¡El nombre de usuario ya está en uso!</span>";
            $envioError .= "?err_nombre=$err_nombre";
        }
    }
    header("Location: $envioError");
}

function crearUsuarioContrasena($nombre, $contrasena, $poblacion)
{
    $nombre = explode(" ", $nombre);
    $poblacion = explode(" ", $poblacion);


    $usuario = implode("_", $nombre) . "_" . implode("_", $poblacion);

    return ["usuario" => $usuario, "contrasena" => $contrasena];
}
