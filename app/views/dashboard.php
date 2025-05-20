<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/assets/css/dashboard.css">
    <title>Dashboard Gescofrade</title>
    <?php
        require("inventario.php");
    ?>
</head>

<body>
    <header>
        <h1 id="nombreHermandad">(NOMBRE HERMANDAD)</h1>
    </header>
    <main class="main">
        <aside class="sidebar">
            <img id="logo" src="../../public/assets/img/logoGescofradeWhite.png" alt="">
            <ul class="list">
                <?php 
                    mostrarModulosContratados();
                ?>
                <li><a href="">Ajustes</a></li>
            </ul>
        </aside>
        <div class="sections">
            <section class="cards-section">
                <div class="card">
                    <div class="card-data">
                        <img src="../../public/assets/img/members.svg" class="card-icon" alt="icono">
                        <p>Miembros registrados</p>
                        <h1>150</h1>
                    </div>
                </div>
                <div class="card">
                    <div class="card-data">
                        <img src="../../public/assets/img/cuotas.svg" class="card-icon" alt="icono">
                        <p>Cuotas pendientes</p>
                        <h1>8</h1>
                    </div>
                </div>
                <div class="card">
                    <div class="card-data">
                        <img src="../../public/assets/img/cortejo.svg" class="card-icon" alt="icono">
                        <p>Cortejo actualizado</p>
                        <h1>Undefined</h1>
                    </div>
                </div>
                <div class="card">
                    <div class="card-data">
                        <img src="../../public/assets/img/inventario.svg" class="card-icon" alt="icono">
                        <p>Inventario</p>
                        <h1>Undefined</h1>
                    </div>
                </div>
                <div class="card">
                    <div class="card-data">
                        <img src="../../public/assets/img/correspondencia.svg" class="card-icon" alt="icono">
                        <p>Correspondencia</p>
                        <h1>Undefined</h1>
                    </div>
                </div>
                <div class="card">
                    <div class="card-data">
                        <img src="../../public/assets/img/3d.svg" class="card-icon" alt="icono">
                        <p>Diseño 3D</p>
                        <h1>Undefined</h1>
                    </div>
                </div>
            </section>
            <section class="graphics-section">
                <div class="graphic">

                </div>
                <div class="events">

                </div>
            </section>
        </div>
    </main>
</body>

</html>