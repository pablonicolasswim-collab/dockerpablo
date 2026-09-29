<?php
// Página de inicio PHP
require_once 'config.php';

$conn = getConnection();
$resultado = $conn->query("SELECT DATABASE() as db_actual");
$row = $resultado->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP con Docker</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; }
        h1 { color: #333; }
        .info { background: #e8f5e9; padding: 15px; border-left: 4px solid #4caf50; margin: 10px 0; }
        .code { background: #f5f5f5; padding: 10px; border-radius: 4px; font-family: monospace; }
        a { color: #2196f3; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🐳 Proyecto Docker - PHP, Nginx, MySQL</h1>
        
        <div class="info">
            <strong>✅ PHP está funcionando correctamente</strong>
        </div>
        
        <h2>Información del Sistema</h2>
        <ul>
            <li><strong>Versión PHP:</strong> <?php echo phpversion(); ?></li>
            <li><strong>Base de datos activa:</strong> <?php echo $row['db_actual']; ?></li>
            <li><strong>Servidor:</strong> <?php echo $_SERVER['SERVER_SOFTWARE']; ?></li>
            <li><strong>IP del cliente:</strong> <?php echo $_SERVER['REMOTE_ADDR']; ?></li>
        </ul>
        
        <h2>URLs Disponibles</h2>
        <ul>
            <li><a href="/api.php">API REST de prueba</a></li>
            <li><a href="http://localhost:8080" target="_blank">phpMyAdmin (puerto 8080)</a></li>
        </ul>
        
        <h2>Módulos PHP Cargados</h2>
        <div class="code">
            <?php
            $extensions = get_loaded_extensions();
            echo implode(', ', array_slice($extensions, 0, 10));
            echo '...';
            ?>
        </div>
    </div>
</body>
</html>
