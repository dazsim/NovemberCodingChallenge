<?php
// Unset all of the session vars.
$_SESSION = array();

//delete cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// destroy session
session_destroy();
$sorry = "Congratulations. You are Logged Out.";
header('Location: index.php?messagetype=success&message='.urlencode($sorry)); 

quit();
?>