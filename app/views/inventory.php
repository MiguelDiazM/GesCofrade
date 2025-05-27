<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventario</title>
    <link rel="stylesheet" href="../../public/assets/css/inventario.css">
    <script src="../../public/assets/js/inventory.js"></script>
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
                    <th>Referencia</th>
                    <th>Elemento</th>
                    <th>Descripción</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>HBOR001XHS</td>
                    <td>Palmas para la Borriquita</td>
                    <td>Palmas blancas trenzadas</td>
                    <td>
                        <img src="../../public/assets/img/edit.svg" alt="Editar" class="btn-editar">
                        <img src="../../public/assets/img/delete.svg" alt="Borrar" class="btn-borrar">
                    </td>
                </tr>
                <tr>
                    <td>HBOR001XHS</td>
                    <td>Palmas para la Borriquita</td>
                    <td>Palmas blancas trenzadas</td>
                    <td>
                        <img src="../../public/assets/img/edit.svg" alt="Editar" class="btn-editar">
                        <img src="../../public/assets/img/delete.svg" alt="Borrar" class="btn-borrar">
                    </td>
                </tr>
                <tr>
                    <td>HBOR001XHS</td>
                    <td>Palmas para la Borriquita</td>
                    <td>Palmas blancas trenzadas</td>
                    <td>
                        <img src="../../public/assets/img/edit.svg" alt="Editar" class="btn-editar">
                        <img src="../../public/assets/img/delete.svg" alt="Borrar" class="btn-borrar">
                    </td>
                </tr>
                <tr>
                    <td>HBOR001XHS</td>
                    <td>Palmas para la Borriquita</td>
                    <td>Palmas blancas trenzadas</td>
                    <td>
                        <img src="../../public/assets/img/edit.svg" alt="Editar" class="btn-editar">
                        <img src="../../public/assets/img/delete.svg" alt="Borrar" class="btn-borrar">
                    </td>
                </tr>
                <tr>
                    <td>HBOR001XHS</td>
                    <td>Palmas para la Borriquita</td>
                    <td>Palmas blancas trenzadas</td>
                    <td>
                        <img src="../../public/assets/img/edit.svg" alt="Editar" class="btn-editar">
                        <img src="../../public/assets/img/delete.svg" alt="Borrar" class="btn-borrar">
                    </td>
                </tr>
                <tr>
                    <td>HBOR001XHS</td>
                    <td>Palmas para la Borriquita</td>
                    <td>Palmas blancas trenzadas</td>
                    <td>
                        <img src="../../public/assets/img/edit.svg" alt="Editar" class="btn-editar">
                        <img src="../../public/assets/img/delete.svg" alt="Borrar" class="btn-borrar">
                    </td>
                </tr>
                <tr>
                    <td>HBOR001XHS</td>
                    <td>Palmas para la Borriquita</td>
                    <td>Palmas blancas trenzadas</td>
                    <td>
                        <img src="../../public/assets/img/edit.svg" alt="Editar" class="btn-editar">
                        <img src="../../public/assets/img/delete.svg" alt="Borrar" class="btn-borrar">
                    </td>
                </tr>
                <tr>
                    <td>HBOR001XHS</td>
                    <td>Palmas para la Borriquita</td>
                    <td>Palmas blancas trenzadas</td>
                    <td>
                        <img src="../../public/assets/img/edit.svg" alt="Editar" class="btn-editar">
                        <img src="../../public/assets/img/delete.svg" alt="Borrar" class="btn-borrar">
                    </td>
                </tr>
            </tbody>
        </table>
        <section id="formulario-editar">
            <h3>Editar elemento</h3>
            <form id="form-editar">
                <label for="referencia">Referencia</label>
                <input type="text" id="referencia" name="referencia">

                <label for="elemento">Elemento</label>
                <input type="text" id="elemento" name="elemento">

                <label for="descripcion">Descripción</label>
                <input type="text" id="descripcion" name="descripcion">

                <button type="submit">Guardar cambios</button>
            </form>
        </section>
    </section>
</body>

</html>