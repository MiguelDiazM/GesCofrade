    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    require("../../config/database.php");

    session_start();

    if (isset($_SESSION["usuario"])) {
        header("Location: ../../public/index.php");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST["user"] ?? "";
        $contrasena = $_POST["password"] ?? "";

        $consulta = "SELECT * FROM usuarios WHERE usuario = :u";
        $stmt = $_conexion->prepare($consulta);
        $stmt->execute([
            ":u" => $nombre
        ]);
        $datos = $stmt->fetch();
        if ($datos) {

            if (password_verify($contrasena, $datos["contrasena"])) {
                $consulta = "SELECT id_hermandad FROM usuarios WHERE usuario = :u";
                $stmt = $_conexion->prepare($consulta);
                $stmt->execute([
                    ":u" => $nombre
                ]);
                $datos = $stmt->fetch();


                $_SESSION["usuario"] = $nombre;
                $_SESSION["id_hermandad"] = $datos[0];
                header("Location: ../../public/index.php");
                exit;
            } else {
                $err_contrasena = "<span class='bg-warning'>La contraseña no coincide.</span>";
                header("Location: ../views/login.php?err_contrasena=$err_contrasena");
            }
        } else {
            $err_nombre = "<span class='bg-warning'>El nombre de usuario no se encuentra en la base de datos.</span>";
            header("Location: ../views/login.php?err_nombre=$err_nombre");
        }
    }
    ?>