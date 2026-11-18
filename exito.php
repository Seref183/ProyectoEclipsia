exito.php
<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>¡Sesión Iniciada!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffe6f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card-exito {
            background: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(255, 182, 193, 0.6);
            text-align: center;
            border: 2px solid #ffb6c1;
            width: 350px;
        }
        h1 {
            color: #d87093;
            font-size: 24px;
            margin-bottom: 10px;
        }
        p {
            color: #666;
            margin-bottom: 25px;
        }
        .btn-volver {
            display: inline-block;
            background-color: #ffb6c1;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            transition: background 0.3s;
        }
        .btn-volver:hover {
            background-color: #ff91a4;
        }
    </style>
</head>
<body>
    <div class="card-exito">
        <h1>¡Iniciaste sesión con éxito! 🌸</h1>
        <p>Bienvenido/a, <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong></p>
        <a href="index.php" class="btn-volver">Ir al inicio</a>
    </div>
</body>
</html>