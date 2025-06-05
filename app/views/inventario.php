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
        <div>
            <a href="../../public/index.php"><img src="../../public/assets/img/logoGescofradeWhite.png" alt="Logo Gescofrade" id="logo"></a>
        </div>
        <div></div>
        <div class="auth-area" id="authArea">
            <div class="user-icon" id="userIcon"><img src="../../public/assets/img/profile2.svg" id="profile"></div>
            <div class="dropdown" id="dropdownMenu">
                <a href="../../public/index.php">Inicio</a>
                <a href="../../app/views/dashboard.php">Dashboard</a>
                <a href="../../app/controllers/logout.php">Cerrar sesión</a>
            </div>
        </div>
    </header>
    <section class="section-tabla">
        <div class="barra-superior">
            <a href="../../app/views/dashboard.php" class="botones boton">Volver a Dashboard</a>
            <input type="text" placeholder="Buscar..." id="buscador">
            <div class="botones">
                <button id="btn-filtrar" class="boton">Limpiar filtro</button>
                <button id="btn-nuevo" class="boton boton-azul">Nuevo</button>
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

                        <form action="../controllers/inventarioLogic.php" method="POST">
                            <input type="hidden" name="control" value="borrar">
                            <input type="hidden" name="referencia" value=<?php echo $elemento["referencia"] ?>>

                            <button type="submit" style="border:none; background:none; padding:0;">
                                <img src="../../public/assets/img/delete.svg" alt="Enviar" width="100" height="50">
                            </button>
                        </form>
                    </td>
                <?php
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <?php
        if (isset($_GET["err_referencia"])) echo "<p>" . $_GET["err_referencia"] . "</p>";
        if (isset($_GET["err_elemento"])) echo "<p>" . $_GET["err_elemento"] . "</p>";
        if (isset($_GET["err_descripcion"])) echo "<p>" . $_GET["err_descripcion"] . "</p>";


        ?>

        <section id="formulario-editar">
            <form class="form-editar" method="POST" action="../controllers/inventarioLogic.php">
                <h3>Editar elemento</h3>
                <input type="hidden" name="control" value="editar">

                <label for="referencia">Referencia</label>
                <input readonly type="text" id="referencia" name="referencia">

                <label for="elemento">Elemento</label>
                <input type="text" id="elemento" name="elemento">

                <label for="descripcion">Descripción</label>
                <input type="text" id="descripcion" name="descripcion">

                <input type="submit" value="Guardar cambios">
            </form>
        </section>

        <section id="formulario-nuevo">
            <form class="form-nuevo" method="POST" action="../controllers/inventarioLogic.php">
                <h3>Nuevo elemento</h3>
                <input type="hidden" name="control" value="nuevo">
                <input type="hidden" name="id_hermandad" value=<?php echo $_SESSION["id_hermandad"] ?>>
                <label for="referencia">Referencia</label>
                <input type="text" id="referencia" name="referencia">

                <?php
                if (isset($_GET["err_referencia"])) echo "<p>" . $_GET["err_referencia"] . "</p>";
                ?>

                <label for="elemento">Elemento</label>
                <input type="text" id="elemento" name="elemento">

                <?php
                if (isset($_GET["err_elemento"])) echo "<p>" . $_GET["err_elemento"] . "</p>";
                ?>

                <label for="descripcion">Descripción</label>
                <input type="text" id="descripcion" name="descripcion">

                <?php
                if (isset($_GET["err_descripcion"])) echo "<p>" . $_GET["err_descripcion"] . "</p>";
                ?>

                <input type="submit" value="Guardar cambios">
            </form>
        </section>
    </section>
    </div>
</body>

</html>