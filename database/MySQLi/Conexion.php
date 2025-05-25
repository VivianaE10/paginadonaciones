<?php

include_once __DIR__ . '/../../constantes/string_constantes.php';
include_once __DIR__ . '/../../constantes/db_config.php';

function createConnection(array $dbCredentials): ?mysqli {
    $host = $dbCredentials[GeneralConfig::HOST_DB->value];
    $username = $dbCredentials[GeneralConfig::USERNAME_DB->value];
    $password = $dbCredentials[GeneralConfig::PASSWORD_DB->value];
    $database = $dbCredentials[GeneralConfig::DATABASE_DB->value];

    mysqli_report(MYSQLI_REPORT_OFF);

    $conexion = new mysqli($host, $username, $password, $database);

    if ($conexion->connect_error) {
        error_log("Error de conexión a la base de datos: (" . $conexion->connect_errno . ") " . $conexion->connect_error);
        return null;
    }

    if (!$conexion->set_charset("utf8mb4")) {
        error_log("Error al establecer el charset UTF-8: " . $conexion->error);
    }

    return $conexion;
}


//-> la flecha significa poo
// hay dos formas de conectarnos una es con programacion orientada a objetos y la otra la procedural
//Forma Procedural
// $mysqli = mysqli_connect($sever, $username, $password, $database);
//forma de comprobar conexion procedural 
// if(!$mysqli) 
// die("fallo la conexion" . mysqli_connect_error())
