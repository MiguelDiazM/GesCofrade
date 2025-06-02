<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/assets/css/dashboard.css">
    <script src="../../public/assets/js/dashboard.js"></script>
    <title>Dashboard Gescofrade</title>

    <?php
    require("../controllers/hermanosLogic.php");
    require("../controllers/dashboardLogic.php");
    require("../controllers/inventarioLogic.php");
    session_start();
    ?>
</head>


<body>
    <header>
        <div>

            <a href="../../public/index.php"><img id="logo" src="../../public/assets/img/logoGescofradeWhite.png" alt=""></a>
        </div>
        <div></div>
        <div class="auth-area" id="authArea">
            <div class="user-icon" id="userIcon"><img src="../../public/assets/img/profile2.svg" id="profile"></div>
            <div class="dropdown" id="dropdownMenu">
                <a href="../../app/controllers/logout.php">Cerrar sesión</a>
            </div>
        </div>
    </header>
    <main class="main">
        <aside id="sidebar" class="sidebar">

            <ul class="list">
                <img id="btnToggleSidebar" src="../../public/assets/img/sidebar-toggle.svg" aria-label="Mostrar/Ocultar menú"></img>
                <img id="btnToggleTheme" src="../../public/assets/img/modo_oscuro.svg" alt="">
                <li><a href="../../public/index.php"><img src="../../public/assets/img/inicio.svg" alt=""><span class="sidebar-text">Inicio</span></a></li>
                <li><a href="hermanos.php"><img src="../../public/assets/img/hermanos.svg" alt=""><span class="sidebar-text">Hermanos</span></a></li>
                <li><a href="#"><img src="../../public/assets/img/cortejo.svg" alt=""><span class="sidebar-text">Cortejo</span></a></li>
                <li><a href="inventario.php"><img src="../../public/assets/img/inventario.svg" alt=""><span class="sidebar-text">Inventario</span></a></li>
                <li><a href="#"><img src="../../public/assets/img/cuotas.svg" alt=""><span class="sidebar-text">Cuotas</span></a></li>
                <li><a href="#"><img src="../../public/assets/img/correspondencia.svg" alt=""><span class="sidebar-text">Correspondencia</span></a></li>
                <li><a href="#"><img src="../../public/assets/img/3d.svg" alt=""><span class="sidebar-text">Diseño 3D</span></a></li>
                <li><a href="#"><img src="../../public/assets/img/ajustes.svg" alt=""><span class="sidebar-text">Ajustes</span></a></li>
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
                    </div>
                </div>
                <div class="card">
                    <div class="card-data">
                        <img src="../../public/assets/img/3d.svg" class="card-icon" alt="icono">
                        <p>Diseño 3D</p>
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
                    <div>
                        <h1>Eventos importantes</h1>
                        <button id="mostrarTodos">Mostrar todos</button>
                    </div>
                    <div class="event">
                        Traslado
                        <p class="fechaEvento">25/01/2025</p>
                    </div>
                    <div class="event">Procesión
                        <p class="fechaEvento">17/03/2025</p>
                    </div>
                    <div class="event">Ensayo
                        <p class="fechaEvento">04/03/2025</p>
                    </div>
                    <div class="event">Traslado
                        <p class="fechaEvento">18/05/2025</p>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>
</html>