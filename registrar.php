
<?php
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['usuario'] ?? '';
    $pass = $_POST['password'] ?? '';

    if (!empty($user) && !empty($pass)) {
        // Cifrar la contraseña por seguridad
        $pass_cifrada = password_hash($pass, PASSWORD_DEFAULT);

        // Guardamos en la nueva tabla 'cuentas'
        $sql = "INSERT INTO cuentas (usuario, password) VALUES (?, ?)";
        $stmt = $conexion->prepare($sql);

        if ($stmt === false) {
            die("Error en la consulta: " . $conexion->error);
        }

        $stmt->bind_param("ss", $user, $pass_cifrada);

        if ($stmt->execute()) {
            echo "<script>alert('¡Registro exitoso! Ya puedes iniciar sesión.'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('El usuario ya existe o hubo un error.'); window.location='index.php';</script>";
        }
        
        $stmt->close();
    }
    $conexion->close();
} else {
    header("Location: index.php");
    exit();
}
?>