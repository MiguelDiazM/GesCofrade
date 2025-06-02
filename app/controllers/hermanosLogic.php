<?php
require("../../config/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $control = true;
    $err = "?";
    if ($_POST["control"] == "editar") {
        if (isset($_POST["dni"])) {
            $dni = $_POST["dni"];

            $consulta = "SELECT * FROM hermanos WHERE DNI = :d";
            $stmt = $_conexion->prepare($consulta);
            $stmt->execute([
                ":d" => $dni
            ]);

            if ($stmt->rowCount() > 0) {
                $datosAntiguos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $control = false;
            }
        } else {
            $control = false;
        }

        if (!$control) {
            $err .= "err_referencia=No existe esa referencia en la BBDD&";
            header("Location: ../views/inventario.php$err");
        }

        $tmp_nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
        $tmp_apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : null;
        $tmp_direccion = isset($_POST["direccion"]) ? $_POST["direccion"] : null;
        $tmp_telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : null;

        if ($tmp_nombre == null) {
            $err .= "err_nombre=Debes introducir un nombre&";
        } else {
            $nombre = htmlspecialchars($tmp_nombre);
        }

        if ($tmp_apellido == null) {
            $err .= "err_apellido=Debes introducir un apellido&";
        } else {
            $apellido = htmlspecialchars($tmp_apellido);
        }

        if ($tmp_direccion == null) {
            $err .= "err_direccion=Debes introducir una direccion&";
        } else {
            $direccion = htmlspecialchars($tmp_direccion);
        }

        if ($tmp_telefono == null) {
            $err .= "err_telefono=Debes introducir un telefono&";
        } else {
            $telefono = htmlspecialchars($tmp_telefono);
        }

        if (isset($nombre) && isset($apellido) && isset($direccion) && isset($telefono)) {
            if ($nombre === "") {
                $nombre = $datosAntiguos["nombre"];
            }
            if ($apellido === "") {
                $apellido = $datosAntiguos["apellido"];
            }
            if ($direccion === "") {
                $direccion = $datosAntiguos["direccion"];
            }
            if ($telefono === "") {
                $telefono = $datosAntiguos["telefono"];
            }

            $consulta = "UPDATE Hermanos SET nombre = :e, apellido = :a, direccion = :d, telefono = :t WHERE DNI = :dni";
            $stmt = $_conexion->prepare($consulta);
            $stmt->execute([
                ":e" => $nombre,
                ":a" => $apellido,
                ":d" => $direccion,
                ":t" => $telefono,
                ":dni" => $dni
            ]);
        }
        header("Location: ../views/hermanos.php$err");
    } else if ($_POST["control"] == "nuevo") {
        if (isset($_POST["dni"])) {
            $dni = $_POST["dni"];

            $consulta = "SELECT * FROM hermanos WHERE DNI = :d";
            $stmt = $_conexion->prepare($consulta);
            $stmt->execute([
                ":d" => $dni
            ]);

            if ($stmt->rowCount() > 0) {
                $control = false;
            }
        } else {
            $control = false;
        }

        if (!$control) {
            $err .= "err_referencia=&";
            header("Location: ../views/inventario.php$err");
        }

        $tmp_nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
        $tmp_apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : null;
        $tmp_direccion = isset($_POST["direccion"]) ? $_POST["direccion"] : null;
        $tmp_telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : null;

        if ($tmp_nombre == null) {
            $err .= "err_nombre=Debes introducir un nombre&";
        } else {
            $nombre = htmlspecialchars($tmp_nombre);
        }

        if ($tmp_apellido == null) {
            $err .= "err_apellido=Debes introducir un apellido&";
        } else {
            $apellido = htmlspecialchars($tmp_apellido);
        }

        if ($tmp_direccion == null) {
            $err .= "err_direccion=Debes introducir una direccion&";
        } else {
            $direccion = htmlspecialchars($tmp_direccion);
        }

        if ($tmp_telefono == null) {
            $err .= "err_telefono=Debes introducir un telefono&";
        } else {
            $telefono = htmlspecialchars($tmp_telefono);
        }

        if (isset($nombre) && isset($apellido) && isset($direccion) && isset($telefono)) {
            if ($nombre === "") {
                $nombre = $datosAntiguos["nombre"];
            }
            if ($apellido === "") {
                $apellido = $datosAntiguos["apellido"];
            }
            if ($direccion === "") {
                $direccion = $datosAntiguos["direccion"];
            }
            if ($telefono === "") {
                $telefono = $datosAntiguos["telefono"];
            }



            $consulta = "UPDATE Hermanos SET nombre = :e, apellido = :a, direccion = :d, telefono = :t WHERE DNI = :dni";
            $stmt = $_conexion->prepare($consulta);
            $stmt->execute([
                ":e" => $nombre,
                ":a" => $apellido,
                ":d" => $direccion,
                ":t" => $telefono,
                ":dni" => $dni
            ]);
        }
        header("Location: ../views/hermanos.php$err");
    }
}

function mostrarHermanos()
{
    global $_conexion;

    if (!isset($_SESSION["id_hermandad"])) {
        return [];
    }

    $id_hermandad = $_SESSION["id_hermandad"];

    $consulta = "SELECT * FROM Hermanos WHERE JSON_CONTAINS(id_hermandad,(:i) , '$');";
    $stmt = $_conexion->prepare($consulta);
    $stmt->execute([":i" => $id_hermandad]);

    $hermanos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $hermanos;
}
