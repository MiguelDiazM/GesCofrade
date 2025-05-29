<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventario</title>
    <link rel="stylesheet" href="../../public/assets/css/inventario.css">
    <script src="../../public/assets/js/inventory.js"></script>
    <?php
    require("../controllers/inventarioLogic.php");
    session_start();
    ?>
</head>

<body>
    <header>
        <a href="dashboard.php"><img id="logo" src="../../public/assets/img/logoGescofradeWhite.png" alt=""></a>

    </header>
    <section class="section-tabla">
        <div class="barra-superior">
            <input type="text" placeholder="Buscar..." id="buscador">
            <div class="botones">
                <button class="boton">Filtrar</button>
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

                foreach ($elementosInventario as $elemento) {
                    echo "<tr>";
                    echo "<td>" . $elemento["referencia"] . "</td>";
                    echo "<td>" . $elemento["elemento"] . "</td>";
                    echo "<td>" . $elemento["descripcion"] . "</td>";

                ?>
                    <td>
                        <img src="../../public/assets/img/edit.svg" alt="Editar" class="btn-editar">
                        <img src="../../public/assets/img/delete.svg" alt="Borrar" class="btn-borrar">
                    </td>
                <?php
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <?php
            if(isset($_GET["err_referencia"])) echo "<p>". $_GET["err_referencia"] ."</p>";
            if(isset($_GET["err_elemento"])) echo "<p>". $_GET["err_elemento"] ."</p>";
            if(isset($_GET["err_descripcion"])) echo "<p>". $_GET["err_descripcion"] ."</p>";
        ?>
        <section id="formulario-editar">
            <h3>Editar elemento</h3>
            <form class="form-editar" method="POST" action="../controllers/inventarioLogic.php">
                <input type="hidden" name="control" value = "editar">
                <label for="referencia">Referencia</label>
                <input readonly type="text" id="referencia" name="referencia">

                <label for="elemento">Elemento</label>
                <input type="text" id="elemento" name="elemento">

                <label for="descripcion">Descripción</label>
                <input type="text" id="descripcion" name="descripcion">

                <input type="submit" value="Guardar cambios">
            </form>
        </section>
    </section>
    </div>
</body>
</html>