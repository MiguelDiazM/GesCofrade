<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <?php 
        error_reporting(E_ALL);
        ini_set("display_errors",1);
        require "database.php";
    ?>

</head>
<body>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $nombre = $_POST["nombre"] ?? "";
            $contrasena = $_POST["contrasena"] ?? "";

            $consulta = "SELECT * FROM usuarios WHERE usuario = ?";
            $stmt = $_conexion->prepare($consulta);
            $stmt->execute([$nombre]);
            $datos = $stmt->fetch();

            if ($datos) {
                if (password_verify($contrasena, $datos["contrasena"])) {
                    session_start();
                    $_SESSION["usuario"] = $nombre;
                    $_SESSION["admin"] = $datos["admin"];
                    header("Location: ../public/index.php");
                    exit;
                } else {
                    $err_contrasena = "<span class='bg-warning'>La contraseña no coincide.</span>";
                }
            } else {
                $err_nombre = "<span class='bg-warning'>El nombre de usuario no se encuentra en la base de datos.</span>";
            }
        }
    ?>

    <div class="container m-5">
        <h1>Formulario de inicio de sesión</h1>
        <form action="" method="post" enctype="multipart/form-data" class="col-4">
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input type="text" name="nombre" class="form-control">
                <?php if (isset($err_nombre)) echo $err_nombre; ?> 
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contrasena" class="form-control">
                <?php if (isset($err_contrasena)) echo $err_contrasena; ?> 
            </div>
            <div class="mb-3">
                <input type="submit" value="Iniciar sesión" class="btn btn-primary">
            </div>
        </form>
        <br>
        <h3>Si no tienes cuenta todavía, regístrate aquí:</h3>
        <a href="signup.php" class="btn btn-secondary">Registrarse</a>
    </div>
</body>
</html>