<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRARSE</title>
    <link rel="stylesheet" href="../../public/assets/css/signup.css">
</head>

<body>
    <header>
        <a href="../../public/index.php"><img src="../../public/assets/img/logoGescofradeWhite.png" alt="Logo Gescofrade" id="logo"></a>
    </header>
    <div class="signup">
        <div class="logo">GESCOFRADE</div>
        <h1>Crea una cuenta</h1>
        <form action="../controllers/signupLogic.php" method="post" class="col-4">
            <div class="main">
                <input type="text" name="nombre" class="form-control" placeholder="Nombre de usuario">
                <?php if (isset($_GET["err_nombre"])) echo $_GET["err_nombre"]; ?>
            </div>
            <div class="main">
                <input type="password" name="contrasena" class="form-control" placeholder="Contraseña">
                <?php if (isset($_GET["err_contrasena"])) echo $_GET["err_contrasena"]; ?>
            </div>
            <div class="main">
                <input type="text" name="poblacion" class="form-control" placeholder="Ciudad">
                <?php if (isset($_GET["err_city"])) echo $_GET["err_city"]; ?>
            </div>
            <div class="type">
                <label for="tipo" class="form-label">Tipo</label>
                <select name="tipo">
                    <option value="penitencia">Penitencia</option>
                    <option value="gloria">Gloria</option>
                </select>
                <?php if (isset($_GET["err_tipo"])) echo $_GET["err_tipo"]; ?>
            </div>
            <div class="main">
                <input type="submit" id="signUpButton" value="Registrarse" class="btn btn-primary">
            </div>
        </form>
        <?php if (isset($_GET["err_usuario"])) echo $_GET["err_usuario"]; ?>
        <br>
        <div class="login">
            ¿No tienes cuenta? <a href="login.php">inicia sesión</a>
        </div>
    </div>
</body>

</html>