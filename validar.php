

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['usuario'] ?? '';
    $pass = $_POST['password'] ?? '';

    // Consultamos en la nueva tabla 'cuentas'
    $sql = "SELECT id, usuario, password FROM cuentas WHERE usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado && $resultado->num_rows === 1) {
        $row = $resultado->fetch_assoc();
        
        if (password_verify($pass, $row['password'])) {
            $_SESSION['usuario'] = $row['usuario'];
            header("Location: exito.php");
            exit();
        } else {
            echo "<script>alert('Contraseña incorrecta'); window.location='index.php#modalLogin';</script>";
        }
    } else {
        echo "<script>alert('El usuario no existe'); window.location='index.php#modalLogin';</script>";
    }
    
    if (isset($stmt)) $stmt->close();
    if (isset($conexion)) $conexion->close();
} else {
    header("Location: index.php");
    exit();
}
?>