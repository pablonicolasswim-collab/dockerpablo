# Nginx configuration documentation

## Características configuradas

- Puerto: 80
- Raíz de documentos: /var/www/html
- Índice: index.php, index.html
- FastCGI: conectado a contenedor PHP en puerto 9000

## Caché de archivos estáticos
- CSS, JavaScript, imágenes: 1 año
- Compresión automática

## Seguridad
- Bloquea acceso a archivos ocultos (.)
- Redirige URLs amigables a index.php

## Logs
- Access: /var/log/nginx/access.log
- Error: /var/log/nginx/error.log

## URLs amigables
Las peticiones se redirigen a index.php para manejar rutas personalizadas.
