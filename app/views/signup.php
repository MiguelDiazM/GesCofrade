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
    <img src="../../public\assets\img\img\logoGescofrade.png" alt="Logo Gescofrade" id="logo">
</header>
<div class="container-login">
        <h1>Crea una cuenta</h1>
        <form action="../controllers/signupLogic.php" method="post" class="col-4">
            <div class="name">
                <label class="form-label">Nombre de usuario</label>
                <input type="text" name="nombre" class="form-control">
                <?php  if (isset($_GET["err_nombre"])) echo $_GET["err_nombre"]; ?> 
            </div>
            <div class="password">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contrasena" class="form-control">
                <?php  if (isset($_GET["err_contrasena"])) echo $_GET["err_contrasena"]; ?> 
            </div>
            <div class="city">
                <label class="form-label">Población</label>
                <input type="text" name="poblacion" class="form-control">
            </div>
            <div class="type">
                <label for="tipo" class="form-label">Tipo</label>
                <select name="tipo">
                    <option value="penitencia">Penitencia</option>
                    <option value="gloria">Gloria</option>
                </select>
            </div>
            <div class="submit">
                <input type="submit" value="Registrarse" class="btn btn-primary">
            </div>
        </form>
        <br>
        <p>Si ya tienes una cuenta, inicia sesión</p>
        <div class="linkLogin">
        <a href="login.php" class="btn btn-secondary"><p>Iniciar sesión</p></a>
        </div> 
    </div>
</body>
</html>