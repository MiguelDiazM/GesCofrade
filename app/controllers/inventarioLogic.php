<?php

function mostrarInventario()
{
    require("../../config/database.php"); // Aquí deberías tener la conexión PDO en $conexion
    session_start();

    if (!isset($_SESSION["id_hermandad"])) {
        return [];
    }

    $id_hermandad = $_SESSION["id_hermandad"];

    $consulta = "SELECT referencia, elemento, descripcion FROM Inventario WHERE id_hermandad = :i";
    $stmt = $_conexion->prepare($consulta);
    $stmt->execute([":i" => $id_hermandad]);

    $inventario = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $inventario;
}

