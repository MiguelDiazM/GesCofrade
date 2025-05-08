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
            <img src="assets/img/img/logoProvisional.png" alt="Gescofrade">
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
            <img src="assets/img/img/profile.png" id="profile" alt="">
            <a href="../app/controllers/signup.php">Sign Up</a> 
            <a href="../app/views/login.php">Login</a>
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
        <p>
            Facilitamos la administración de tu cofradía
        </p>
    </div>
    <div class="dataFirstSection">
        <table class="tableFirstSection">
            <tr>
                <td>680</td>
                <td>8K+</td>
                <td>500+</td>
            </tr>
            <tr>
                <td>Hermanos activos</td>
                <td>Cofradías asociadas</td>
                <td>Suscripciones</td>
            </tr>
        </table>
    </div>
    </section>

    <section class="secondSection"> 
        <h1>Nuestras suscripciones más populares...</h1>
        <div>
        <article class="standard-suscription">
            <h1>Suscripción estándar</h1>
            <p>Ideal para cofradías pequeñas</p>
        </article>
        <article class="professional-suscription">
            <h1>Suscripción profesional</h1>
            <p>Pensado para cofradías de más de 100 hermanos</p>
        </article>
        <article class="premium-suscription">
             <h1>Suscripción premium</h1>
             <p>Para las cofradías que quieren llegar al siguiente nivel</p>
        </article>
    </div>
    </section>
    <footer>
        <div class="redesSociales">
            <ul>
                <li><img src="assets/img/img/instagram.png" alt=""></li>
                <li><img src="assets/img/img/facebook.png" alt=""></li>
                <li><img src="assets/img/img/twitter.png" alt=""></li>
                <li><img src="assets/img/img/linkedin.png" alt=""></li>
            </ul>        
        </div>
    </footer>
</body>
</html>