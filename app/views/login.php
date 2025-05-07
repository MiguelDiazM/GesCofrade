<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GESCOFRADE - Login</title>
    <link rel="stylesheet" href="../../public/assets/css/login.css">
    <link rel="stylesheet" href="../../config/bootstrap/bootstrap.min.css">
</head>
<body>
    <div class="login">
        <div class="logo">GESCOFRADE</div>
        <h1>Inicia sesión en tu cuenta</h1>
        
       <form action="../controllers/login.php" method="POST">
            <div class="main">
                <label for="user">Email</label>
                <input type="text" id="user" name="user" placeholder="User">
                <?php if(isset($_GET["err_nombre"])) echo $_GET["err_nombre"]; ?>
            </div>
            
            <div class="main">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" >
                <?php if(isset($_GET["err_contrasena"])) echo $_GET["err_contrasena"]; ?>
            </div>
            
            <input type="submit" class="login-button" value="ENVIAr"></input>
       </form>
        
        <div class="signup">
            ¿Tienes cuenta? <a href="signup.html">Registrarse</a>
        </div>
    </div>
</body>
</html>