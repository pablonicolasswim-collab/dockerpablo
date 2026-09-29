// SQL para crear tablas de ejemplo

CREATE TABLE IF NOT EXISTS usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    contraseña VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    activo BOOLEAN DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS productos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT DEFAULT 0,
    categoria VARCHAR(50),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS pedidos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    estado VARCHAR(50) DEFAULT 'pendiente',
    fecha_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Insertar datos de ejemplo
INSERT INTO usuarios (nombre, email, contraseña) VALUES
('Juan Pérez', 'juan@example.com', 'password123'),
('María García', 'maria@example.com', 'password123'),
('Carlos López', 'carlos@example.com', 'password123');

INSERT INTO productos (nombre, descripcion, precio, stock, categoria) VALUES
('Laptop Dell', 'Laptop de 15 pulgadas', 899.99, 5, 'Electrónica'),
('Mouse Logitech', 'Mouse inalámbrico', 29.99, 50, 'Accesorios'),
('Teclado Mecánico', 'Teclado RGB', 129.99, 15, 'Accesorios');
