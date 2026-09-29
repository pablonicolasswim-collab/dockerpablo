<?php
// Archivo de configuración de PHP
// Conexión a base de datos

define('DB_HOST', 'mysql');
define('DB_USER', 'root');
define('DB_PASS', 'root123');
define('DB_NAME', 'app_db');
define('DB_PORT', 3306);

// Función de conexión
function getConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    
    $conn->set_charset("utf8");
    return $conn;
}

// Función para ejecutar queries
function query($sql) {
    $conn = getConnection();
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

?>
