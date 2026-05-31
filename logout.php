<?php
session_start();

// 1. Alle Session-Variablen löschen
$_SESSION = array();

// 2. Cookie des Browsers löschen
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 86400,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 3. Session vernichten
session_destroy();

// 4. Cache verhindern (wichtig für Browser, die die alte Seite anzeigen wollen)
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// 5. Umleitung
header("Location: index.php");
exit;
?>