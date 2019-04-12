<?php
session_start();

$_SESSION = array();

define('RUTA', 'http://localhost:8080/WebApplicationPCSA/front-end/');

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir la sesión.

session_destroy();

header('Location:' . RUTA."index.php");

?>