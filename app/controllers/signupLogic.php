<?php
require "../../config/database.php";

session_start();

if (isset($_SESSION["usuario"])) {
    header("Location: ../../public/index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tmp_nombre = $_POST["nombre"] ?? "";
    $tmp_contrasena = $_POST["contrasena"] ?? "";
    $tmp_city = $_POST["poblacion"] ?? "";
    $tmp_tipo = $_POST["tipo"] ?? "";

    $envioError = "../views/signup.php?";

    if (empty($tmp_nombre)) {
        $err_nombre = "El nombre no puede estar vacío";
        $envioError .= "&err_nombre=$err_nombre";
    } else {
        $nombre = $tmp_nombre;
    }

    if (empty($tmp_contrasena)) {
        $err_contrasena = "La contraseña no puede estar vacía";
        $envioError .= "&err_contrasena=$err_contrasena";
    } else {
        $contrasena = $tmp_contrasena;
    }

    if (empty($tmp_city)) {
        $err_city = "Debes introducir una ciudad";
        $envioError .= "&err_city=$err_city";
    } else {
        $city = $tmp_city;
    }

    if (empty($tmp_tipo)) {
        $err_tipo = "Debes introducir un tipo";
        $envioError .= "&err_tipo=$err_tipo";
    } else {
        $tipo = $tmp_tipo;
    }


    if (isset($nombre) && isset($contrasena) && isset($city) && isset($tipo)) {
        try {
            // La hermandad y sus dos usuarios se crean juntos o no se crea nada
            $_conexion->beginTransaction();

            $consulta = "INSERT INTO hermandad (nombre, tipo, ubicacion) VALUES (:n, :t, :u)";
            $stmt = $_conexion->prepare($consulta);
            $stmt->execute([
                ":n" => $nombre,
                ":t" => $tipo,
                ":u" => $city
            ]);
            $id_hermandad = $_conexion->lastInsertId();

            $usuarios = [];
            $usuarios[] = crearUsuarioContrasena($nombre, $contrasena, $city);
            $usuarios[] = crearUsuarioAdminContrasena($nombre, $contrasena, $city);

            foreach ($usuarios as $usuario) {
                $insert = "INSERT INTO usuarios (usuario, contrasena, id_hermandad) VALUES (:usuario, :contrasena, :id)";
                $stmt_insert = $_conexion->prepare($insert);

                $stmt_insert->execute([
                    ":usuario" => $usuario["usuario"],
                    ":contrasena" => $usuario["contrasena"],
                    ":id" => $id_hermandad
                ]);
            }

            $_conexion->commit();
        } catch (PDOException $e) {
            $_conexion->rollBack();
            // 1062: el nombre de usuario generado ya existe
            if ($e->errorInfo[1] == 1062) {
                header("Location: ../views/signup.php?err_usuario=Ya existe una hermandad registrada con ese nombre y ciudad");
                exit;
            }
            throw $e;
        }
        header("Location: ../views/login.php");
        exit;
    }
    header("Location: $envioError");
    exit;
}

function crearUsuarioContrasena($nombre, $contrasena, $poblacion)
{
    $nombre = explode(" ", $nombre);
    $poblacion = explode(" ", $poblacion);

    $usuario = implode("_", $nombre) . "_" . implode("_", $poblacion);
    $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
    return ["usuario" => $usuario, "contrasena" => $contrasena_hash];
}

function crearUsuarioAdminContrasena($nombre, $contrasena, $poblacion)
{
    $nombre = explode(" ", $nombre);
    $poblacion = explode(" ", $poblacion);

    $usuario = "admin_" . implode("_", $nombre) . "_" . implode("_", $poblacion);
    $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
    return ["usuario" => $usuario, "contrasena" => $contrasena_hash];
}
