<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hermanos</title>
    <link rel="stylesheet" href="../../public/assets/css/inventario.css">
    <script src="../../public/assets/js/hermanos.js"></script>
    <?php
    require("../controllers/hermanosLogic.php");
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
            <input type="text" placeholder="Buscar por DNI..." id="buscador">
            <div class="botones">
                <button id="btn-filtrar" class="boton">Limpiar filtro</button>
                <button id="btn-nuevo" class="boton boton-azul">Nuevo</button>
            </div>
        </div>

        <table id="tabla">
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $hermanos = mostrarHermanos();

                foreach ($hermanos as $elemento) {
                    echo "<tr>";
                    echo "<td>" . $elemento["DNI"] . "</td>";
                    echo "<td>" . $elemento["nombre"] . "</td>";
                    echo "<td>" . $elemento["apellido"] . "</td>";
                    echo "<td>" . $elemento["direccion"] . "</td>";
                    echo "<td>" . $elemento["telefono"] . "</td>";
                ?>
                    <td>
                        <img src="../../public/assets/img/edit.svg" alt="Editar" class="btn-editar">
                        <form action="../controllers/hermanosLogic.php" method="POST">
                            <input type="hidden" name="control" value="borrar">
                            <input type="hidden" name="dni" value=<?php echo $elemento["DNI"] ?>>

                            <button type="submit" style="border:none; background:none; padding:0;">
                                <img class="btn-borrar" src="../../public/assets/img/delete.svg" alt="Enviar" width="100" height="50">

                            </button>
                        </form>
                    </td>
                <?php
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
         <section id="formulario-editar">
            <form class="form-editar" method="POST" action="../controllers/hermanosLogic.php">
                <h3>Editar elemento</h3>
                <input type="hidden" name="control" value="editar">
                <label for="dni">DNI</label>
                <input readonly type="text" id="dni" name="dni">

                <?php
                if (isset($_GET["err_dni"])) echo "<p>" . $_GET["err_dni"] . "</p>";
                ?>

                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre">

                <?php
                if (isset($_GET["err_nombre"])) echo "<p>" . $_GET["err_nombre"] . "</p>";
                ?>

                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido">

                <?php
                if (isset($_GET["err_apellido"])) echo "<p>" . $_GET["err_apellido"] . "</p>";
                ?>

                <label for="direccion">Direccion</label>
                <input type="text" id="direccion" name="direccion">

                <?php
                if (isset($_GET["err_direccion"])) echo "<p>" . $_GET["err_direccion"] . "</p>";
                ?>

                <label for="telefono">Telefono</label>
                <input type="text" id="telefono" name="telefono">

                <?php
                if (isset($_GET["err_telefono"])) echo "<p>" . $_GET["err_telefono"] . "</p>";
                ?>
                
                <input type="submit" value="Guardar cambios">
            </form>
        </section>

        <section id="formulario-nuevo">
            <form class="form-nuevo" method="POST" action="../controllers/hermanosLogic.php">
                <h3>Nuevo hermano</h3>
                <input type="hidden" name="control" value="nuevo">
                <input type="hidden" name="id_hermandad" value=<?php echo $_SESSION["id_hermandad"] ?>>
                <label for="dni">DNI</label>
                <input type="text" id="dni" name="dni">

                <?php
                if (isset($_GET["err_dni"])) echo "<p>" . $_GET["err_dni"] . "</p>";
                ?>

                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre">

                <?php
                if (isset($_GET["err_nombre"])) echo "<p>" . $_GET["err_nombre"] . "</p>";
                ?>

                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido">

                <?php
                if (isset($_GET["err_apellido"])) echo "<p>" . $_GET["err_apellido"] . "</p>";
                ?>

                <label for="direccion">Direccion</label>
                <input type="text" id="direccion" name="direccion">
                
                <?php
                if (isset($_GET["err_direccion"])) echo "<p>" . $_GET["err_direccion"] . "</p>";
                ?>

                <label for="telefono">Telefono</label>
                <input type="text" id="telefono" name="telefono">

                <?php
                if (isset($_GET["err_telefono"])) echo "<p>" . $_GET["err_telefono"] . "</p>";
                ?>

                <input type="submit" value="Guardar cambios">
            </form>
        </section>
    </section>
    </div>
</body>

</html>