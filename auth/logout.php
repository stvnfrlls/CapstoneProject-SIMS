<?php 

require_once("../assets/php/server.php");

session_destroy();
session_unset();
clearstatcache();

header('Location: login.php');
?>

