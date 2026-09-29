# Docker Multi-Container Stack: PHP, Nginx, MySQL, MyAdmin

Proyecto completo de desarrollo con 4 contenedores Docker interconectados.

## 🐳 Contenedores Incluidos

| Servicio | Puerto | Imagen | Propósito |
|----------|--------|--------|-----------|
| **Nginx** | 80, 443 | nginx:latest | Servidor web/proxy reverso |
| **PHP-FPM** | 9000 | php:8.2-fpm | Intérprete PHP |
| **MySQL** | 3306 | mysql:8.0 | Base de datos |
| **phpMyAdmin** | 8080 | phpmyadmin:latest | Gestor de base de datos web |

## 📁 Estructura del Proyecto

```
docker-containers-proyecto/
├── docker-compose.yml          # Configuración de servicios
├── README.md                   # Este archivo
├── .gitignore                  # Excepciones de Git
│
├── nginx/                      # Configuración Nginx
│   ├── default.conf           # Configuración del servidor
│   └── README.md              # Documentación Nginx
│
├── php/                        # Archivos PHP
│   ├── index.php              # Página principal
│   ├── api.php                # API REST de ejemplo
│   └── config.php             # Configuración de BD
│
├── src/                        # Código fuente compartido
│   ├── app.js                 # JavaScript frontend
│   ├── styles.css             # Estilos
│   ├── init.sql               # Script SQL inicial
│   └── README.md              # Documentación
│
└── html/                       # Archivos estáticos
    └── index.html             # Página estática de prueba
```

## 🚀 Inicio Rápido

### 1. Requisitos
- Docker Desktop instalado
- Docker Compose (incluido en Docker Desktop)
- ~800MB de espacio en disco

### 2. Levantar los contenedores
```bash
docker compose up -d --pull always
```

### 3. Verificar estado
```bash
docker compose ps
```

Deberías ver 4 contenedores en estado "Up":
```
CONTAINER ID   IMAGE              STATUS          PORTS
...            nginx:latest       Up 2 minutes    0.0.0.0:80->80/tcp
...            php:8.2-fpm       Up 2 minutes    9000/tcp
...            mysql:8.0         Up 2 minutes    0.0.0.0:3306->3306/tcp
...            phpmyadmin:latest Up 2 minutes    0.0.0.0:8080->80/tcp
```

## 🌐 Acceso a los Servicios

### 🖥️ Nginx + PHP (Servidor Web)
- **URL**: http://localhost
- **Archivos**: `./php/`
- **Características**:
  - Proxy reverso a PHP-FPM
  - URLs amigables
  - Caché de assets
  - Compresión automática

### 🐘 PHP
- **Versión**: 8.2 con FPM
- **Directorio**: `/var/www/html`
- **Archivos de ejemplo**:
  - `index.php` - Página de inicio con información del sistema
  - `api.php` - API REST de ejemplo
  - `config.php` - Configuración de base de datos

### 🗄️ MySQL
- **Host**: `localhost`
- **Puerto**: `3306`
- **Usuario**: `root`
- **Contraseña**: `root123`
- **Base de datos**: `app_db`

### 🎯 phpMyAdmin
- **URL**: http://localhost:8080
- **Usuario**: `root`
- **Contraseña**: `root123`
- **Servidor**: `mysql`

## 📚 Contenido de las Carpetas

### `/nginx`
- **default.conf**: Configuración del servidor web
  - Listen: puerto 80
  - FastCGI pass a PHP en puerto 9000
  - Caché de archivos estáticos (1 año)
  - URLs amigables (rewrite)
  - Bloqueo de archivos sensibles

### `/php`
- **index.php**: Página principal con información del sistema
- **api.php**: API REST de ejemplo (GET /api/usuarios)
- **config.php**: Funciones de conexión a BD

### `/src`
- **app.js**: Cliente JavaScript para consumir API
- **styles.css**: Estilos CSS moderno (gradientes, responsive)
- **init.sql**: Script SQL con tablas y datos de ejemplo
  - Tabla usuarios
  - Tabla productos
  - Tabla pedidos
  - Datos de prueba

### `/html`
- Archivos estáticos HTML de prueba

## 🔌 Conexión a Base de Datos

### Desde PHP (dentro del contenedor)
```php
<?php
$conn = new mysqli("mysql", "root", "root123", "app_db");
?>
```

### Desde cliente local
```php
$conn = new mysqli("localhost", "root", "root123", "app_db", 3306);
```

### Desde Node.js
```javascript
const mysql = require('mysql2/promise');
const conn = await mysql.createConnection({
  host: 'localhost',
  port: 3306,
  user: 'root',
  password: 'root123',
  database: 'app_db'
});
```

### Desde Python
```python
import mysql.connector
conn = mysql.connector.connect(
  host="localhost",
  port=3306,
  user="root",
  password="root123",
  database="app_db"
)
```

## 🛠️ Comandos Útiles

### Gestión de contenedores
```bash
# Iniciar
docker compose up -d --pull always

# Detener
docker compose stop

# Reiniciar
docker compose restart

# Ver logs
docker compose logs -f

# Ver logs de un servicio
docker compose logs -f php
docker compose logs -f nginx
docker compose logs -f mysql

# Eliminar todo (incluyendo volúmenes)
docker compose down -v
```

### Acceder a terminales

```bash
# Terminal MySQL
docker exec -it mysql_db mysql -u root -p
# Contraseña: root123

# Terminal PHP
docker exec -it php_app bash

# Terminal Nginx
docker exec -it nginx_server bash
```

### Ejecutar comandos

```bash
# Instalar paquetes PHP
docker exec -it php_app pecl install redis

# Ejecutar script SQL
docker exec -i mysql_db mysql -u root -proot123 app_db < src/init.sql

# Ver logs del contenedor
docker exec mysql_db tail -f /var/log/mysql/error.log
```

## 📝 Ejemplos de Uso

### Crear una página PHP simple
```bash
echo '<?php echo "Hola Mundo"; ?>' > php/hello.php
```
Accede a: http://localhost/hello.php

### Crear una tabla
```bash
docker exec -i mysql_db mysql -u root -proot123 app_db << EOF
CREATE TABLE posts (
  id INT PRIMARY KEY AUTO_INCREMENT,
  titulo VARCHAR(200),
  contenido TEXT
);
EOF
```

### Ver datos desde PHP
```bash
# Agrega a php/index.php:
<?php
$conn = new mysqli("mysql", "root", "root123", "app_db");
$result = $conn->query("SELECT * FROM usuarios");
while ($row = $result->fetch_assoc()) {
  echo $row['nombre'] . "<br>";
}
?>
```

## 🔐 Datos de Prueba

El archivo `src/init.sql` crea automáticamente:

### Tabla usuarios
```
id | nombre      | email          | contraseña  | fecha_registro      | activo
1  | Juan Pérez  | juan@...       | password123 | 2024-01-01 10:00:00 | 1
2  | María García| maria@...      | password123 | 2024-01-01 10:00:00 | 1
3  | Carlos López| carlos@...     | password123 | 2024-01-01 10:00:00 | 1
```

### Tabla productos
```
id | nombre              | precio  | stock | categoria
1  | Laptop Dell         | 899.99  | 5     | Electrónica
2  | Mouse Logitech      | 29.99   | 50    | Accesorios
3  | Teclado Mecánico    | 129.99  | 15    | Accesorios
```

### Tabla pedidos
```
id | usuario_id | total   | estado    | fecha_pedido
```

## 🐛 Solucionar Problemas

### Error: "Puerto 80 ya está en uso"
```bash
# Cambiar puerto en docker-compose.yml:
ports:
  - "8000:80"  # En lugar de 80:80

# Acceder a http://localhost:8000
```

### Error de conexión a MySQL
```bash
# Esperar a que MySQL inicie (hasta 30s)
docker compose logs mysql

# Reintentar
docker compose down -v
docker compose up -d --pull always
docker compose logs -f mysql
```

### PHP no encuentra MySQL
```bash
# Verificar que MySQL esté corriendo
docker ps

# Verificar conectividad desde PHP
docker exec php_app ping mysql

# Ver variables de entorno
docker exec php_app env | grep MYSQL
```

### Nginx muestra error 502 Bad Gateway
```bash
# Verificar que PHP está corriendo
docker ps

# Ver logs de Nginx
docker compose logs nginx

# Verificar configuración
docker exec nginx_server nginx -t
```

## 🔄 Persistencia de Datos

- **MySQL**: Los datos se guardan en el volumen `mysql_data`
- **PHP**: Los archivos se sincronizan desde `./php/`
- **Nginx**: La configuración se sincroniza desde `./nginx/`

Para eliminar datos de MySQL:
```bash
docker volume rm docker-containers-proyecto_mysql_data
```

## 🌐 CORS y Seguridad

Para habilitar CORS en PHP:
```php
<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
?>
```

## 📊 Monitoreo

Ver estadísticas en tiempo real:
```bash
docker stats
```

Ver eventos de Docker:
```bash
docker compose events
```

## 🚀 Deployment

Para subir a producción:

1. Cambiar contraseñas en `docker-compose.yml`
2. Habilitar HTTPS en Nginx
3. Añadir certificados SSL
4. Configurar backups de MySQL
5. Usar `.env` para variables sensibles
6. Limitar recursos (memory, cpu)

Ejemplo con `.env`:
```
MYSQL_ROOT_PASSWORD=contraseña_segura_aqui
DB_NAME=app_db
```

## 📖 Documentación Adicional

- [Documentación Nginx](https://nginx.org/en/docs/)
- [Documentación PHP-FPM](https://www.php.net/manual/en/install.fpm.php)
- [Documentación MySQL](https://dev.mysql.com/doc/)
- [Documentación phpMyAdmin](https://www.phpmyadmin.net/docs/)
- [Documentación Docker Compose](https://docs.docker.com/compose/)

## 📝 Notas

- Los archivos PHP se pueden editar en tiempo real (volumen montado)
- MySQL tiene un delay de inicialización (~10s)
- El volumen de MySQL persiste entre reinicios
- Los logs están accesibles con `docker compose logs`

## 👨‍💼 Autor

Proyecto educativo para clase de contenedores Docker.

## 📄 Licencia

Libre para usar y modificar.

---

**Creado con Docker Compose** | 2026
