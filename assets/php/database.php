<?php

global $mysqli;

$mysqli = new mysqli("localhost", "u952901270_admin0326", "giTG^W3y", "u952901270_sis_cdsp");

if ($mysqli->connect_errno) {
    echo "Error Connecting: " . $mysqli->connect_error;
    exit();
}
