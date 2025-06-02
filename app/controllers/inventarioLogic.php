<?php
require("../../config/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $control = true;
    $err = "?";
    if ($_POST["control"] == "editar") {
        if (isset($_POST["referencia"])) {
            $referencia = $_POST["referencia"];

            $consulta = "SELECT * FROM inventario WHERE referencia = :r";
            $stmt = $_conexion->prepare($consulta);
            $stmt->execute([
                ":r" => $referencia
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
            $err .= "err_referencia=No existe esa referencia en la BBDD";
            header("Location: ../views/inventario.php$err");
        }

        $tmp_elemento = isset($_POST["elemento"]) ? $_POST["elemento"] : null;
        $tmp_descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : null;

        if ($tmp_elemento == null) {
            $err .= "&err_elemento=Debes introducir un nombre";
        } else {
            $elemento = htmlspecialchars($tmp_elemento);
        }

        if ($tmp_descripcion == null) {
            $err .= "&err_descripcion=Debes introducir una descripcion";
        } else {
            $descripcion = htmlspecialchars($tmp_descripcion);
        }

        if (isset($elemento) && isset($descripcion)) {
            if ($elemento === "") {
                $elemento = $datosAntiguos["elemento"];
            }
            if ($descripcion === "") {
                $descripcion = $datosAntiguos["descripcion"];
            }

            $consulta = "UPDATE inventario SET elemento = :e, descripcion = :d WHERE referencia = :r";
            $stmt = $_conexion->prepare($consulta);
            $stmt->execute([
                ":e" => $elemento,
                ":d" => $descripcion,
                ":r" => $referencia
            ]);
        }

        header("Location: ../views/inventario.php$err");
    }
}

function mostrarInventario()
{
    global $_conexion;

    if (!isset($_SESSION["id_hermandad"])) {
        return [];
    }

    $id_hermandad = $_SESSION["id_hermandad"];

    $consulta = "SELECT referencia, elemento, descripcion FROM inventario WHERE id_hermandad = :i";
    $stmt = $_conexion->prepare($consulta);
    $stmt->execute([":i" => $id_hermandad]);

    $inventario = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $inventario;
}
