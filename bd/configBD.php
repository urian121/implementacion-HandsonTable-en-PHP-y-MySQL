
<?php
$ModoProduccion = true;
if ($ModoProduccion) {
    $host = "localhost";
    $usuario = "root";
    $contrasena = "";
    $base_de_datos = "bd_handsontable";
} else {
    $host = "121.81.220.00";
    $usuario = "root_123";
    $contrasena = "1234569";
    $base_de_datos = "bd_prod";
}

$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
