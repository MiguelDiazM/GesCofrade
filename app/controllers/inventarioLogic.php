<?php

function mostrarModulosContratados()
{
    require("../../config/database.php");
    session_start();

    $id_hermandad = $_SESSION["id_hermandad"];

    $consulta = "SELECT referencia, elemento, descripcion FROM Inventario WHERE id_hermandad = (:i)"; 
    $stmt = $conexion->prepare($consulta);
    $stmt->execute([
        ":i" => $id_hermandad
    ]);


    $resultado = $stmt->get_result();
    $inventario = [];

    while ($fila = $resultado->fetch_assoc()) {
        $inventario[] = $fila;
    }

    $stmt->close();

    return $inventario;
}
