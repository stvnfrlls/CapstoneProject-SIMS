<?php

global $mysqli;

$mysqli = new mysqli("localhost", "u952901270_admin2311	", "giTG^W3y", "u952901270_sforms_cdsp");

if ($mysqli->connect_errno) {
    echo "Error Connecting: " . $mysqli->connect_error;
    exit();
}
