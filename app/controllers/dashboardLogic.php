<?php
function mostrarNombreHermandad()
{
    require("../../config/database.php");

    if ($_SESSION["id_hermandad"] == "") {
        return "No existe";
    }
    $id_hermandad = $_SESSION["id_hermandad"];

    $consulta = "SELECT nombre FROM hermandad WHERE id_hermandad = (:i)";

    $stmt = $_conexion->prepare($consulta);
    $stmt->execute([
        ":i" => $id_hermandad
    ]);

    $nombreHermandad = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $nombreHermandad[0]["nombre"];
}
