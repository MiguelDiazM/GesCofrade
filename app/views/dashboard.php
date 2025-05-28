<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/assets/css/dashboard.css">
    <script src="../../public/assets/js/dashboard.js"></script>
    <title>Dashboard Gescofrade</title>
    <button id="btnToggleSidebar" aria-label="Mostrar/Ocultar menú">MENÚ</button>
    <?php
    require("../controllers/hermanosLogic.php");
    require("../controllers/dashboardLogic.php");
    require("../controllers/inventarioLogic.php");
    session_start();
    ?>
</head>

<body>
    <header>
        <h1 id="nombreHermandad">
            <?php
            echo mostrarNombreHermandad();
            ?>
        </h1>
    </header>
    <main class="main">
        <aside id="sidebar" class="sidebar">
            <img id="logo" src="../../public/assets/img/logoGescofradeWhite.png" alt="">
            <ul class="list">
                <li><a href="../../public/index.php">Inicio</a></li>
                <li><a href="hermanos.php">Hermanos</a></li>
                <li><a href="#">Cortejo</a></li>
                <li><a href="inventario.php">Inventario</a></li>
                <li><a href="#">Cuotas</a></li>
                <li><a href="#">Correspondencia</a></li>
                <li><a href="#">Diseño 3D</a></li>
                <li><a href="#">Ajustes</a></li>
                <li id="btnToggleTheme"><a href="#">Alternar modo claro/oscuro</a></li>
            </ul>
        </aside>
        <div class="sections">
            <section class="cards-section">
                <div class="card">
                    <div class="card-data">
                        <img src="../../public/assets/img/members.svg" class="card-icon" alt="icono">
                        <p>Miembros registrados</p>
                        <h1>
                            <?php
                            echo count(mostrarHermanos());
                            ?>
                        </h1>
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
                        <h1>
                            <?php
                            echo count(mostrarInventario());
                            ?>
                        </h1>
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
                <div class="sub_board">
                    <div class="sep_board"></div>
                    <div class="cont_board">
                        <div class="graf_board">
                            <div class="barra">
                                <div class="sub_barra b1">
                                    <div class="tag_g">35</div>
                                    <div class="tag_leyenda">Enero</div>
                                </div>
                            </div>
                            <div class="barra">
                                <div class="sub_barra b2">
                                    <div class="tag_g">45</div>
                                    <div class="tag_leyenda">Febrero</div>
                                </div>
                            </div>
                            <div class="barra">
                                <div class="sub_barra b3">
                                    <div class="tag_g">55</div>
                                    <div class="tag_leyenda">Marzo</div>
                                </div>
                            </div>
                            <div class="barra">
                                <div class="sub_barra b4">
                                    <div class="tag_g">75</div>
                                    <div class="tag_leyenda">Abril</div>
                                </div>
                            </div>
                            <div class="barra">
                                <div class="sub_barra b5">
                                    <div class="tag_g">85</div>
                                    <div class="tag_leyenda">Mayo</div>
                                </div>
                            </div>
                        </div>
                        <div class="tag_board">
                            <div class="sub_tag_board">
                                <div>100 -</div>
                                <div>90 -</div>
                                <div>80 -</div>
                                <div>70 -</div>
                                <div>60 -</div>
                                <div>50 -</div>
                                <div>40 -</div>
                                <div>30 -</div>
                                <div>20 -</div>
                                <div>10 -</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="events">
                    <h1>Eventos importantes</h1>
                    <div class="event">
                        Traslado
                        <p class="fechaEvento">25/07/2025</p>
                    </div>
                    <div class="event">Procesión
                        <p class="fechaEvento">04/08/2025</p>
                    </div>
                    <div class="event">Ensayo
                        <p class="fechaEvento">17/08/2025</p>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>

</html>