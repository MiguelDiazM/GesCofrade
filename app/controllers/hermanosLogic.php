<?php
require("../../config/database.php");   

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    if (!isset($_SESSION["id_hermandad"])) {
        header("Location: ../views/login.php");
        exit;
    }
    $id_hermandad = $_SESSION["id_hermandad"];
    if (!isset($_POST["csrf"], $_SESSION["csrf"]) || !hash_equals($_SESSION["csrf"], $_POST["csrf"])) {
        header("Location: ../views/hermanos.php");
        exit;
    }

    $control = true;
    $err = "?";
    if ($_POST["control"] == "editar") {
        if (isset($_POST["dni"])) {
            $dni = $_POST["dni"];

            $consulta = "SELECT * FROM hermanos WHERE DNI = :d AND JSON_CONTAINS(id_hermandad, :i, '$')";
            $stmt = $_conexion->prepare($consulta);
            $stmt->execute([
                ":d" => $dni,
                ":i" => $id_hermandad
            ]);

            if ($stmt->rowCount() > 0) {
                $datosAntiguos = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $control = false;
            }
        } else {
            $control = false;
        }

        if (!$control) {
            $err .= "err_referencia=" . urlencode("No existe esa referencia en la BBDD") . "&";
            header("Location: ../views/hermanos.php$err");
            exit;
        }

        $tmp_nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
        $tmp_apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : null;
        $tmp_direccion = isset($_POST["direccion"]) ? $_POST["direccion"] : null;
        $tmp_telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : null;

        if ($tmp_nombre == null) {
            $err .= "err_nombre=" . urlencode("Debes introducir un nombre") . "&";
        } else {
            $nombre = $tmp_nombre;
        }

        if ($tmp_apellido == null) {
            $err .= "err_apellido=" . urlencode("Debes introducir un apellido") . "&";
        } else {
            $apellido = $tmp_apellido;
        }

        if ($tmp_direccion == null) {
            $err .= "err_direccion=" . urlencode("Debes introducir una direccion") . "&";
        } else {
            $direccion = $tmp_direccion;
        }

        if ($tmp_telefono == null) {
            $err .= "err_telefono=" . urlencode("Debes introducir un telefono") . "&";
        } else {
            $telefono = $tmp_telefono;
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

            $consulta = "UPDATE hermanos SET nombre = :e, apellido = :a, direccion = :d, telefono = :t WHERE DNI = :dni";
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
        $dni = isset($_POST["dni"]) ? trim($_POST["dni"]) : "";

        if ($dni === "") {
            $err .= "err_dni=" . urlencode("Debes introducir un DNI") . "&";
            header("Location: ../views/hermanos.php$err");
            exit;
        }

        $tmp_nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
        $tmp_apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : null;
        $tmp_direccion = isset($_POST["direccion"]) ? $_POST["direccion"] : null;
        $tmp_telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : null;

        if ($tmp_nombre == null) {
            $err .= "err_nombre=" . urlencode("Debes introducir un nombre") . "&";
        } else {
            $nombre = $tmp_nombre;
        }

        if ($tmp_apellido == null) {
            $err .= "err_apellido=" . urlencode("Debes introducir un apellido") . "&";
        } else {
            $apellido = $tmp_apellido;
        }

        if ($tmp_direccion == null) {
            $err .= "err_direccion=" . urlencode("Debes introducir una direccion") . "&";
        } else {
            $direccion = $tmp_direccion;
        }

        if ($tmp_telefono == null) {
            $err .= "err_telefono=" . urlencode("Debes introducir un telefono") . "&";
        } else {
            $telefono = $tmp_telefono;
        }

        if (isset($nombre) && isset($apellido) && isset($direccion) && isset($telefono)) {
            try {
                // La comprobación del DNI y la escritura van en la misma transacción;
                // FOR UPDATE bloquea la fila (o el hueco si no existe) frente a altas simultáneas
                $_conexion->beginTransaction();

                $consulta = "SELECT id_hermandad FROM hermanos WHERE DNI = :dni FOR UPDATE";
                $stmt = $_conexion->prepare($consulta);
                $stmt->execute([
                    ":dni" => $dni
                ]);
                $hermano = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$hermano) {
                    $consulta = "INSERT INTO hermanos (DNI, nombre, apellido, direccion, telefono, id_hermandad) VALUES (:dni, :e, :a, :d, :t, :id)";
                    $stmt = $_conexion->prepare($consulta);
                    $stmt->execute([
                        ":e" => $nombre,
                        ":a" => $apellido,
                        ":d" => $direccion,
                        ":t" => $telefono,
                        ":dni" => $dni,
                        ":id" => json_encode([intval($id_hermandad)])
                    ]);
                } else {
                    $hermandades = json_decode($hermano["id_hermandad"]);

                    if (in_array(intval($id_hermandad), $hermandades)) {
                        $_conexion->rollBack();
                        $err .= "err_dni=" . urlencode("Ya existe un hermano con ese DNI en esta hermandad") . "&";
                        header("Location: ../views/hermanos.php$err");
                        exit;
                    }

                    // La persona ya existe en otra hermandad: solo se añade la asociación, sus datos personales no cambian
                    $hermandades[] = intval($id_hermandad);
                    $consulta = "UPDATE hermanos SET id_hermandad = :h WHERE DNI = :dni";
                    $stmt = $_conexion->prepare($consulta);
                    $stmt->execute([
                        ":h" => json_encode($hermandades),
                        ":dni" => $dni
                    ]);
                }

                $_conexion->commit();
            } catch (PDOException $e) {
                $_conexion->rollBack();
                // 1062: otra petición ha dado de alta el mismo DNI a la vez
                if ($e->errorInfo[1] == 1062) {
                    $err .= "err_dni=" . urlencode("Ya existe un hermano con ese DNI") . "&";
                    header("Location: ../views/hermanos.php$err");
                    exit;
                }
                throw $e;
            }
        }
        
    } else if ($_POST["control"] == "borrar") {
        
        $dni = $_POST["dni"];
        $consulta = "SELECT id_hermandad FROM hermanos WHERE DNI = :dni AND JSON_CONTAINS(id_hermandad, :i, '$')";
        $stmt = $_conexion->prepare($consulta);
        $stmt->execute([
            ":dni" => $dni,
            ":i" => $id_hermandad
        ]);
        $hermano = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($hermano) {
            // El hermano solo deja la hermandad actual; si no pertenece a ninguna más, se elimina
            $hermandades = array_values(array_diff(json_decode($hermano["id_hermandad"]), [intval($id_hermandad)]));

            if (count($hermandades) == 0) {
                $consulta = "DELETE FROM hermanos WHERE DNI = :dni";
                $stmt = $_conexion->prepare($consulta);
                $stmt->execute([
                    ":dni" => $dni
                ]);
            } else {
                $consulta = "UPDATE hermanos SET id_hermandad = :h WHERE DNI = :dni";
                $stmt = $_conexion->prepare($consulta);
                $stmt->execute([
                    ":h" => json_encode($hermandades),
                    ":dni" => $dni
                ]);
            }
        }

    }
    header("Location: ../views/hermanos.php$err");
    exit;
}

function mostrarHermanos()
{
    global $_conexion;

    if (!isset($_SESSION["id_hermandad"])) {
        return [];
    }

    $id_hermandad = $_SESSION["id_hermandad"];

    $consulta = "SELECT * FROM hermanos WHERE JSON_CONTAINS(id_hermandad,(:i) , '$');";
    $stmt = $_conexion->prepare($consulta);
    $stmt->execute([":i" => $id_hermandad]);

    $hermanos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $hermanos;
}
