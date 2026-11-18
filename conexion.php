
<?php
$servidor = "localhost";
$usuario = "root";
$password = ""; 
$dbname = "proyecto_tarot_db"; // <-- Apuntando a la nueva base de datos limpia

$conexion = new mysqli($servidor, $usuario, $password, $dbname);

if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}
$conexion->set_charset("utf8");
?>
