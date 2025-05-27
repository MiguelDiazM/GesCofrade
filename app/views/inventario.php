<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventario</title>
    <link rel="stylesheet" href="../../public/assets/css/inventario.css">
    <?php
        require("../controllers/inventarioLogic.php");
    ?>
</head>

<body>
    <div id="contenedor">
        <h1 id="titulo">Inventario</h1>
        <p id="ruta">Inicio > <span class="resaltado">Inventario</span></p>

        <div class="barra-superior">
            <input type="text" placeholder="Buscar producto..." id="buscador">
            <div class="botones">
                <button class="boton">Filtro</button>
                <button class="boton">Exportar</button>
                <button class="boton boton-azul">Nuevo</button>
            </div>
        </div>

        <table id="tabla">
            <thead>
                <tr>
                    <th>Referencia</th>
                    <th>Elemento</th>
                    <th>Descripción</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $elementosInventario = mostrarInventario();

                    foreach($elementosInventario as $elemento){
                        echo "<tr>";    
                        echo "<td>" . $elemento["referencia"] . "</td>";
                        echo "<td>" . $elemento["elemento"] . "</td>";
                        echo "<td>" . $elemento["descripcion"] . "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <div id="paginacion">
            <span class="texto-pagina">1 - 10 de 13 páginas</span>
            <div>
                Página:
                <select id="selector-pagina">
                    <option>1</option>
                    <option>2</option>
                </select>
                <button class="flecha">&lt;</button>
                <button class="flecha">&gt;</button>
            </div>
        </div>
    </div>
</body>

</html>