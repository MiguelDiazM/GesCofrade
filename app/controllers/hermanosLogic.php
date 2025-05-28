<?php

function mostrarHermanos()
{
    require("../../config/database.php");

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

