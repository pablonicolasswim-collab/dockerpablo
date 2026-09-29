<?php
// API REST de ejemplo
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Conexión a MySQL
$conn = new mysqli("mysql", "root", "root123", "app_db");

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Error de conexión a BD: ' . $conn->connect_error]);
    exit;
}

// Rutas simples
if ($path === '/api/usuarios' && $method === 'GET') {
    $result = $conn->query("SELECT * FROM usuarios LIMIT 10");
    $usuarios = [];
    
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $usuarios[] = $row;
        }
    }
    
    echo json_encode(['datos' => $usuarios, 'cantidad' => count($usuarios)]);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Ruta no encontrada']);
}

$conn->close();
?>
