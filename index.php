
<?php
include('conexion.php');

$mensaje_alerta = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['enviar_contacto'])) {
    $nombre = $_POST['nombre'] ?? '';
    $correo = $_POST['email'] ?? '';
    $mensaje = $_POST['mensaje'] ?? '';

    $sql = "INSERT INTO contacto (nombre, correo, mensaje) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sss", $nombre, $correo, $mensaje);

    if ($stmt->execute()) {
        $mensaje_alerta = "¡Mensaje enviado y guardado en la Base de Datos con éxito!";
    } else {
        $mensaje_alerta = "Error al guardar el mensaje: " . $conexion->error;
    }
    if (isset($stmt)) $stmt->close();
}

$busqueda_mayor = $_GET['busqueda_mayor'] ?? '';
if (!empty($busqueda_mayor)) {
    $sql_mayores = "SELECT * FROM arcanos_mayores WHERE nombre LIKE ? OR significado LIKE ?";
    $stmt_m = $conexion->prepare($sql_mayores);
    $param_m = "%" . $busqueda_mayor . "%";
    $stmt_m->bind_param("ss", $param_m, $param_m);
    $stmt_m->execute();
    $resultado_mayores = $stmt_m->get_result();
} else {
    $resultado_mayores = $conexion->query("SELECT * FROM arcanos_mayores");
}

$busqueda_menor = $_GET['busqueda_menor'] ?? '';
if (!empty($busqueda_menor)) {
    $sql_menores = "SELECT * FROM arcanos_menores WHERE nombre LIKE ? OR palo LIKE ? OR significado LIKE ?";
    $stmt_men = $conexion->prepare($sql_menores);
    $param_men = "%" . $busqueda_menor . "%";
    $stmt_men->bind_param("sss", $param_men, $param_men, $param_men);
    $stmt_men->execute();
    $resultado_menores = $stmt_men->get_result();
} else {
    $resultado_menores = $conexion->query("SELECT * FROM arcanos_menores");
}

$resultado_tiradas = $conexion->query("SELECT * FROM tiradas");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eclipsia - Tarot y Tienda</title>
    <!-- Estilos centralizados en la carpeta CSS -->
    <link rel="stylesheet" href="css/layoutp.css">
</head>
<body>

    <div class="browser-frame">
        <header class="site-header">
            <div class="logo-container">
                <span class="logo-icon">⛧⃝𓄃</span>
                <h1 class="site-title">˚⊱Eclipsia⊰˚</h1>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="#inicio">Inicio</a></li>
                    <li><a href="#arcanom">Arcanos Mayores</a></li>
                    <li><a href="#arcanoe">Arcanos Menores</a></li>
                    <li><a href="#tiradas">Tienda</a></li>
                    <li><a href="#modalContacto" class="btn-menu-contacto">Contacto</a></li>
                    <li><a href="#modalRegistro" class="btn-menu-registro">Registro</a></li>
                    <li><a href="#modalLogin" class="btn-menu-login">Entrar</a></li>
                </ul>
            </nav>
        </header>

        <main class="site-main">
            <section class="content-section">
                
                <!-- 1. PANTALLA DE INICIO -->
                <div id="panel-inicio" class="panel-seccion">
                    <span id="inicio"></span>
                    <h2>Explora el Tarot y la Tienda</h2>
                    <p>Aprende sobre sus cartas, símbolos y adquiere tus lecturas profesionales.</p>
                    
                    <?php if (!empty($mensaje_alerta)): ?>
                        <div class="alerta-exito"><?php echo $mensaje_alerta; ?></div>
                    <?php endif; ?>

                    <div class="media-container">
                        <img src="img/tarot.png" alt="Laptop abierta sobre escritorio de madera" class="main-image">
                    </div>
                    <p>Selecciona una categoría en el menú superior para ver la información detallada.</p>
                </div>


                <!-- 2. PANTALLA DE ARCANOS MAYORES -->
                <div id="panel-mayores" class="panel-seccion">
                    <span id="arcanom"></span>
                    <a href="#inicio" class="btn-regresar">← Volver al Inicio</a>
                    <h2>Catálogo de Arcanos Mayores</h2>
                    
                    <form action="index.php#arcanom" method="GET" class="form-busqueda">
                        <input type="text" name="busqueda_mayor" placeholder="Buscar por nombre o significado..." value="<?php echo htmlspecialchars($busqueda_mayor); ?>">
                        <button type="submit" class="btn-buscar">Buscar</button>
                    </form>

                    <hr style="margin-bottom: 20px; border-color: var(--color-detail-rose);">
                    
                    <?php if ($resultado_mayores && $resultado_mayores->num_rows > 0): ?>
                        <?php while($row = $resultado_mayores->fetch_assoc()): ?>
                            <div class="tarjeta-arcano">
                                <h4><?php echo htmlspecialchars($row['nombre']); ?> (Núm: <?php echo htmlspecialchars($row['numero']); ?>)</h4>
                                <p><strong>Significado:</strong> <?php echo htmlspecialchars($row['significado']); ?></p>
                                <p><strong>Invertido:</strong> <?php echo htmlspecialchars($row['significado_invertido']); ?></p>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No se encontraron resultados para tu búsqueda.</p>
                    <?php endif; ?>
                </div>


                <!-- 3. PANTALLA DE ARCANOS MENORES -->
                <div id="panel-menores" class="panel-seccion">
                    <span id="arcanoe"></span>
                    <a href="#inicio" class="btn-regresar">← Volver al Inicio</a>
                    <h2>Catálogo de Arcanos Menores</h2>
                    
                    <form action="index.php#arcanoe" method="GET" class="form-busqueda">
                        <input type="text" name="busqueda_menor" placeholder="Buscar por nombre, palo o significado..." value="<?php echo htmlspecialchars($busqueda_menor); ?>">
                        <button type="submit" class="btn-buscar">Buscar</button>
                    </form>

                    <hr style="margin-bottom: 20px; border-color: var(--color-detail-rose);">
                    
                    <?php if ($resultado_menores && $resultado_menores->num_rows > 0): ?>
                        <?php while($row_m = $resultado_menores->fetch_assoc()): ?>
                            <div class="tarjeta-arcano">
                                <h4><?php echo htmlspecialchars($row_m['nombre']); ?> (Palo: <?php echo htmlspecialchars($row_m['palo']); ?>)</h4>
                                <p><strong>Significado:</strong> <?php echo htmlspecialchars($row_m['significado']); ?></p>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No se encontraron resultados para tu búsqueda.</p>
                    <?php endif; ?>
                </div>


                <!-- 4. PANTALLA DE TIENDA -->
                <div id="panel-tienda" class="panel-seccion">
                    <span id="tiradas"></span>
                    <a href="#inicio" class="btn-regresar">← Volver al Inicio</a>
                    <h2>Tienda / Paquetes de Tiradas</h2>
                    <hr style="margin-bottom: 20px; border-color: var(--color-detail-rose);">

                    <?php if ($resultado_tiradas && $resultado_tiradas->num_rows > 0): ?>
                        <?php while($row_t = $resultado_tiradas->fetch_assoc()): ?>
                            <div class="tarjeta-tienda">
                                <h4><?php echo htmlspecialchars($row_t['nombre']); ?></h4>
                                <p><strong>Tipo:</strong> <?php echo htmlspecialchars($row_t['tipo']); ?> | <strong>Cartas:</strong> <?php echo htmlspecialchars($row_t['num_cartas']); ?></p>
                                <p><?php echo htmlspecialchars($row_t['descripcion']); ?></p>
                                <p class="precio">Precio: $<?php echo number_format($row_t['precio'], 2); ?> MXN</p>
                                <p><small>Disponibilidad: <?php echo htmlspecialchars($row_t['disponibilidad']); ?> cupos</small></p>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>

            </section>

            <!-- BARRA LATERAL -->
            <aside class="sidebar">
                <h3>Más información</h3>
                <ul>
                    <li>Historia del Tarot</li>
                    <li>Guía para principiantes</li>
                    <li>Cómo funciona una lectura</li>
                    <li>Cartas derechas e invertidas</li>
                    <li>Tipos de preguntas</li>
                </ul>
                <div class="info-box">
                    <span class="globe-icon">🃜🃚🃖🃁🂭🂺</span>
                    <p>Adéntrate en el mundo místico del Tarot.</p>
                </div>
            </aside>
        </main>

        <footer class="site-footer">
            <p>&copy; 2025 Mi Sitio Web. Todos los derechos reservados.</p>
        </footer>
    </div>

    <!-- Modales -->
    <div id="modalRegistro" class="modal-overlay">
        <div class="modal-content">
            <a href="#" class="btn-cerrar">&times;</a>
            <h2>Crear Cuenta</h2>
            <form action="registrar.php" method="POST">
                <div class="campo"><label>Nuevo Usuario:</label><input type="text" name="usuario" required></div>
                <div class="campo"><label>Contraseña:</label><input type="password" name="password" required></div>
                <button type="submit" class="btn-accion">Registrarse</button>
            </form>
        </div>
    </div>

    <div id="modalLogin" class="modal-overlay">
        <div class="modal-content">
            <a href="#" class="btn-cerrar">&times;</a>
            <h2>Iniciar Sesión</h2>
            <form action="validar.php" method="POST">
                <div class="campo"><label>Usuario:</label><input type="text" name="usuario" required></div>
                <div class="campo"><label>Contraseña:</label><input type="password" name="password" required></div>
                <button type="submit" class="btn-accion">Entrar</button>
            </form>
        </div>
    </div>

    <div id="modalContacto" class="modal-overlay">
        <div class="modal-content" style="width: 400px;">
            <a href="#" class="btn-cerrar">&times;</a>
            <h2>Contáctanos</h2>
            <form action="index.php" method="POST">
                <input type="hidden" name="enviar_contacto" value="1">
                <div class="campo"><label>Nombre:</label><input type="text" name="nombre" required></div>
                <div class="campo"><label>Correo electrónico:</label><input type="email" name="email" required></div>
                <div class="campo"><label>Mensaje:</label><textarea name="mensaje" rows="4" required></textarea></div>
                <button type="submit" class="btn-accion">Enviar Mensaje</button>
            </form>
        </div>
    </div>

</body>
</html>