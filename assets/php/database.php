<?php

global $mysqli;

$mysqli = new mysqli("localhost", "u952901270_admin2311	", "Eleven.11", "u952901270_sforms_cdsp");

if ($mysqli->connect_errno) {
    echo "Error Connecting: " . $mysqli->connect_error;
    exit();
}
