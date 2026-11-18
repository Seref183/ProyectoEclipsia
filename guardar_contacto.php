<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
// Datos de conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$password = ""; // Cambia esto si tu configuración de XAMPP/MySQL tiene contraseña
$dbname = "proyecto_db";

// Crear la conexión
$conexion = new mysqli($servidor, $usuario, $password, $dbname);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibir los datos enviados por el formulario POST
$nombre = $_POST['nombre'];
$correo = $_POST['email'];
$mensaje = $_POST['mensaje'];

// Insertar en la base de datos usando consultas preparadas para mayor seguridad
$sql = "INSERT INTO contacto (nombre, correo, mensaje) VALUES (?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("sss", $nombre, $correo, $mensaje);

if ($stmt->execute()) {
    echo "<h3>¡Mensaje enviado y guardado en la Base de Datos con éxito!</h3>";
    echo "<a href='contacto.html'>Regresar</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

// Cerrar conexiones
$stmt->close();
$conexion->close();
?>    
</body>
</html>