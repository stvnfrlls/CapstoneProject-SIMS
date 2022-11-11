<?php 

session_destroy();
session_unset();

if (session_unset() && session_destroy()) {
    header('Location: login.php');
}
?>

