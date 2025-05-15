<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gescofrade inicio</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <?php
    session_start();
    ?>
</head>

<body>
    <header>
        <div id="logo">
            <img src="assets/img/logoGescofradeBlack.png" alt="Gescofrade">
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
        <div class="auth-area" id="authArea">
            <?php
            if (!isset($_SESSION['usuario'])) { ?>
                <a href="../app/views/signup.php">Register</a>
                <a href="../app/views/login.php">Log in</a>
            <?php
            } else { ?>
                <div class="user-icon" id="userIcon"><img src="assets/img/persona1review.jpg" id="profile"></div>
                <div class="dropdown" id="dropdownMenu">
                    <a href="#">Dashboard</a>
                    <a href="../app/controllers/logout.php">Cerrar sesión</a>
                </div>
            <?php } ?>
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
                <li><img src="assets/img/instagram.png" alt=""></li>
                <li><img src="assets/img/facebook.png" alt=""></li>
                <li><img src="assets/img/twitter.png" alt=""></li>
                <li><img src="assets/img/linkedin.png" alt=""></li>
            </ul>
        </div>
    </footer>
</body>

</html>

<script>
    let isLoggedIn = <?php echo isset($_SESSION['usuario']) ? 'true' : 'false'; ?>;

    let authArea = document.getElementById("authArea");

    if (isLoggedIn) {
        let userIcon = document.getElementById("userIcon");
        let dropdownMenu = document.getElementById("dropdownMenu");

        userIcon.onclick = function() {
            dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
        };

        // Ocultar el menú si se hace clic fuera
        document.addEventListener("click", function(e) {
            if (!authArea.contains(e.target)) {
                dropdownMenu.style.display = "none";
            }
        });

    }
</script>