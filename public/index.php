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
            <a href="../app/views/signup.php">Sign Up</a> 
            <a href="../app/views/login.php">Login</a>
            <?php 
            /**
                HAY QUE AGREGAR UN LOGOUT QUE SE MUESTRE CON JS CUANDO HAYA UNA SESION INICIADA
            */
            ?>
        </div>
    </header>
    <main>
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
        <article class="suscription" id="standard-suscription">
            <h1>Suscripción estándar</h1>
            <p>Ideal para cofradías pequeñas</p>
        </article>
        <article class="suscription" id="professional-suscription">
            <h1>Suscripción profesional</h1>
            <p>Pensado para cofradías de más de 100 hermanos</p>
        </article>
        <article class="suscription" id="premium-suscription">
             <h1>Suscripción premium</h1>
             <p>Para las cofradías que quieren llegar al siguiente nivel</p>
        </article>
    </div>
    </section>
       
    <section class="section-reviews">
        <h1>¿Qué dicen nuestros clientes de nosotros?</h1>
        <div class="article-reviews">
            <article class="review">
                <div class="person-photo" id="person1"></div>
                <p>Increíble aplicación! Conseguí llevar la administración de mi cofradía a otro nivel.</p>
            </article>
            <article class="review">
                <div class="person-photo" id="person2"></div>
                <p>Es justo lo que necesitábamos, un software intuitivo y escalable.</p>
            </article>
            <article class="review"> 
                <div class="person-photo" id="person3"></div>
                <p>Todos los módulos disponibles son increíbles!! Sobre todo la función de geolocalización.</p>
            </article>
        </div>
    </section>
</main>
    <footer>
        <table class="table-footer">
            <tr>
                <th><a href="#">Aprendizaje</a></th>
                <th><a href="#">Comunidad</a></th>
                <th><a href="#">Empresa</a></th>
            </tr>
            <tr>
                <td><a href="#">Formación y certificación</a></td>
                <td><a href="#">Comunidad de usuarios</a></td>
                <td><a href="#">Acerca de nosotros</a></td>
            </tr>
            <tr>
                <td><a href="#">Blog</a></td>
                <td><a href="#">Programa de afiliados</a></td>
                <td><a href="#">Eventos</a></td>
            </tr>
        </table>
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