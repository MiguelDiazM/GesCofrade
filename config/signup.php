<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRARSE</title>
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

            $tmp_nombre = $_POST["nombre"] ?? "";
            $tmp_contrasena = $_POST["contrasena"] ?? "";
            $tmp_idHermandad = $_POST["id"] ?? "";

            if(empty($tmp_nombre)){
                $err_nombre = "<span class='bg-warning'>El nombre no puede estar vacío</span>";
            } else {
                $nombre = $tmp_nombre;
            }

            if(empty($tmp_contrasena)){
                $err_contrasena = "<span class='bg-warning'>La contraseña no puede estar vacía</span>";
            } else {
                $contrasena = $tmp_contrasena;
            }

            if(isset($tmp_idHermandad)){
                $idHermandad = $tmp_idHermandad;
            } else {
                $err_idHermandad = "<span class='bg-warning'>La id de la hermandad no puede estar vacía</span>";
            }

            if(isset($nombre) && isset($contrasena) && isset($idHermandad)){
                // Comprobamos si el usuario ya existe
                $consulta = "SELECT * FROM usuarios WHERE usuario = ?";
                $stmt = $_conexion->prepare($consulta);
                $stmt->execute([$nombre]);

                if($stmt->rowCount() == 0){
                    $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
                    $insert = "INSERT INTO usuarios (usuario, contrasena, id_hermandad) VALUES (?, ?, ?)";
                    $stmt_insert = $_conexion->prepare($insert);
                    $stmt_insert->execute([$nombre, $contrasena_hash, $idHermandad]);

                    $correcto = "<span class='bg-info'>¡Se registró correctamente!</span>";
                } else {
                    $err_nombre2 = "<span class='bg-warning'>¡El nombre de usuario ya está en uso!</span>";
                }
            }
        }
    ?>

    <div class="container m-5">
        <h1>Formulario de registro</h1>
        <form action="" method="post" enctype="multipart/form-data" class="col-4">
            <div class="mb-3">
                <label class="form-label">Nombre de usuario</label>
                <input type="text" name="nombre" class="form-control">
                <?php  if (isset($err_nombre)) echo $err_nombre; ?> 
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contrasena" class="form-control">
                <?php  if (isset($err_contrasena)) echo $err_contrasena; ?> 
            </div>
            <div class="mb-3">
                <label class="form-label">Id Hermandad</label>
                <input type="number" name="id" class="form-control">
                <?php  if (isset($err_idHermandad)) echo $err_idHermandad; ?> 
            </div>
            <div class="mb-3">
                <input type="submit" value="Registrarse" class="btn btn-primary">
            </div>
        </form>
        <br>
        <h3>Si ya tienes cuenta, inicia sesión</h3>
        <a href="login.php" class="btn btn-secondary">Iniciar sesión</a>

        <?php  
            if(isset($err_nombre2)) echo $err_nombre2; 
            if(isset($correcto)) echo $correcto;
        ?>    
    </div>
</body>
</html>
