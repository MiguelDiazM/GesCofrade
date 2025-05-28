<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventario</title>
    <link rel="stylesheet" href="../../public/assets/css/inventario.css">
    <script src="../../public/assets/js/inventory.js"></script>
    <?php
    require("../controllers/hermanosLogic.php");
    session_start();
    ?>
</head>

<body>
    <header>
        <img id="logo" src="../../public/assets/img/logoGescofradeWhite.png" alt="">

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
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
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
                        <img src="../../public/assets/img/delete.svg" alt="Borrar" class="btn-borrar">
                    </td>
                <?php
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <section id="formulario-editar">
            <h3>Editar elemento</h3>
            <form class="form-editar">
                <input type="hidden" name="editar">
                <label for="referencia">Referencia</label>
                <input type="text" class="referencia" name="referencia">

                <label for="elemento">Elemento</label>
                <input type="text" class="elemento" name="elemento">

                <label for="descripcion">Descripción</label>
                <input type="text" class="descripcion" name="descripcion">

                <button type="submit">Guardar cambios</button>
            </form>
        </section>
    </section>
    </div>
</body>

</html>