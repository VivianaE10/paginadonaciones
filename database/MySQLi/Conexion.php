<?php

$sever = "yamanote.proxy.rlwy.net"; //hos
$port = 31557;
$database = "donaciones";
$username = "root";
$password = "uoqkCVjLUzCPAFJLvDkZpdssluARhvXT";

//Genera la conexion a la base de datos en forma de poo
$mysqli = new mysqli($sever, $username, $password, $database, $port );

//comprobar conexion poo
if ($mysqli->connect_errno)
die("fallo la conexion: {$mysqli->connect_error}");

// esto nos ayuda a utilizar cualquier caracter para hacer la primera consulta a la base de datos
$setnames = $mysqli->prepare("Set names 'utf8'"); 

//$setnames variable que guarda y ejecuta nuestra consulta
if ($setnames->execute()) {
  echo "✅ Conexión exitosa";
} else {
  echo "❌ Falló la configuración";
}


//-> la flecha significa poo
// hay dos formas de conectarnos una es con programacion orientada a objetos y la otra la procedural
//Forma Procedural
// $mysqli = mysqli_connect($sever, $username, $password, $database);
//forma de comprobar conexion procedural 
// if(!$mysqli) 
// die("fallo la conexion" . mysqli_connect_error());

