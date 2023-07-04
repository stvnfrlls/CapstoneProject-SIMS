<?php

global $mysqli;
$envFile = file_get_contents('../.env');

$envVariables = explode("\n", $envFile);
foreach ($envVariables as $envVariable) {
    $envVariable = trim($envVariable);
    if (!empty($envVariable) && strpos($envVariable, '=') !== false) {
        list($key, $value) = explode('=', $envVariable, 2);
        $_ENV[$key] = $value;
        putenv("$key=$value");
    }
}

$mysqli = new mysqli($_ENV['DB_HOST'], getenv('DB_USER'), $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);

if ($mysqli->connect_errno) {
    echo "Error Connecting: " . $mysqli->connect_error;
    exit();
}
