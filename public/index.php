<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gescofrade inicio</title>
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>
    <header>
        <div id="logo">
            <img src="Img/logoProvisional.png" alt="Gescofrade">
        </div>
        <div class="menuHeader">
        <ul>
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a href="#">Noticias</a>
            </li>
            <li>
                <a href="#">Blog</a>
            </li>
            <li>
                <a href="#">Contacto</a>
            </li>
        </ul>
        </div>
        <div class="singupLoginProfile">
            <img src="Img/profile.png" id="profile" alt="">
            <a href="../config/signup.php">Sign Up /</a>
            <a href="../config/login.php">Login</a>
            <?php 
            /**
                HAY QUE AGREGAR UN LOGOUT QUE SE MUESTRE CON JS CUANDO HAYA UNA SESION INICIADA
            */
            ?>
        </div>
    </header>

    <section class="firstSection">
    <div class="textFirstSection">
        <h1 id="h1FirstSection">
            El #1º en administración de cofradías
        </h1>
        <h3>
            Facilitamos la administración de tu cofradía
        </h3>
    </div>
    </section>

    <section class="secondSection"> 
        <h1>Nuestas suscripciones más populares...</h1>
        <div>
        <article>
            Suscripcion 1
        </article>
        <article>
            Suscripcion 2
        </article>
        <article>
            Suscripcion 3
        </article>
        <article>
            Suscripcion 4
        </article>
        <article>
            Suscripcion 5
        </article>
    </div>
    </section>

</body>
</html>