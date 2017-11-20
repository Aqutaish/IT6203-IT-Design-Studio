<?php
session_start();

// Unset all of the session variables.

$_SESSION = array();

 

// If it's desired to kill the session, also delete the session cookie.

// Note: This will destroy the session, and not just the session data!

if (isset($_COOKIE[session_name("PHPSESSID")])) {

    setcookie(session_name("PHPSESSID "), '', time()-42000, '/');

}

 

// Finally, destroy the session.

session_destroy();
header("location: index.php");
?>