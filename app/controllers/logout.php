<?php
session_start();
$_SESSION = [];
setcookie(session_name(), "", time() - 3600, "/");
session_destroy();
header("Location: ../../public/index.php");
exit;
