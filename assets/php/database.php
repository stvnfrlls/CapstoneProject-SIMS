<?php

global $mysqli;

$mysqli = new mysqli("localhost", "u395663555_admin2311", "Eleven.11", "u395663555_sforms_cdsp");

if ($mysqli->connect_errno) {
    echo "Error Connecting: " . $mysqli->connect_error;
    exit();
}
