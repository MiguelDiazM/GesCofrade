<?php

use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    public function testLoginRedirect()
    {
        // Simulamos los datos POST
        $_POST['user'] = 'juan';  // Nombre de usuario (suponiendo que existe en la base de datos)
        $_POST['password'] = '1234';  // Contraseña correcta
        $_SERVER["REQUEST_METHOD"] = "POST";  // Indicamos que es un POST

        // Empezamos el test y capturamos la salida con ob_start
        ob_start();  // Iniciar captura de salida
        session_start();  // Iniciar la sesión
        include __DIR__ . '/../app/controllers/loginLogic.php';  // Incluir el archivo PHP que contiene la lógica
        ob_end_clean();  // Limpiar la salida

        // Verificamos que se haya redirigido a otra página, buscando la cabecera "Location"
        $this->assertStringContainsString('Location: ../../public/index.php', xdebug_get_headers()[0]);
    }

    public function testNoSessionOnInvalidData()
    {
        // Simulamos datos incorrectos
        $_POST['user'] = 'noexiste';  // Usuario no existente
        $_POST['password'] = '1234';  // Contraseña (aunque el usuario no existe)
        $_SERVER["REQUEST_METHOD"] = "POST";  // Indicamos que es un POST

        // Iniciar la ejecución y capturar la salida
        ob_start();
        session_start();
        include __DIR__ . '/../app/controllers/loginLogic.php';  // Incluir el archivo PHP
        ob_end_clean();  // Limpiar la salida

        // Verificamos que no se haya creado la sesión, ya que el usuario no existe
        $this->assertArrayNotHasKey('usuario', $_SESSION);
    }
}
?>
