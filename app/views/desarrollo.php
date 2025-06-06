<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventario</title>
    <link rel="stylesheet" href="../../public/assets/css/desarrollo.css">
    <script src="../../public/assets/js/dashboard.js"></script>
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
                <a href="../../app/views/dashboard.php">Dashboard</a>
                <a href="../../app/controllers/logout.php">Cerrar sesión</a>
            </div>
        </div>
    </header>
</body>
<div class="contenedor">
    <img src="../../public/assets/img/gear-solid.svg" alt="Engranaje" class="icono">
    <h1>¡Esta página está en desarrollo!</h1>
    <p>Próximamente disponible. Estamos trabajando en ello.</p>
</div>

</html>