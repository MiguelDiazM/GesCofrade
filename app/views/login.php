<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GESCOFRADE - Login</title>
    <link rel="stylesheet" href="../../public/assets/css/login.css">
</head>
<body>
    <header>
    <img src="../../public\assets\img\img\logoGescofrade.png" alt="Logo Gescofrade" id="logo">
</header>
    <div class="login">
        <div class="logo">GESCOFRADE</div>
        <h1>Inicia sesión en tu cuenta</h1>
        
       <form action="../controllers/loginLogic.php" method="POST">
            <div class="main">
                <input type="text" id="user" name="user" placeholder="Nombre">
                <?php if(isset($_GET["err_nombre"])) echo $_GET["err_nombre"]; ?>
            </div>
            
            <div class="main">
                <input type="password" id="password" name="password" placeholder="Contraseña" >
                <?php if(isset($_GET["err_contrasena"])) echo $_GET["err_contrasena"]; ?>
            </div>
            
            <input type="submit" class="login-button" value="Iniciar sesión"></input>
       </form>
        
        <div class="signup">
            ¿No tienes cuenta? <a href="signup.php">Regístrate</a>
        </div>
    </div>
</body>
</html>