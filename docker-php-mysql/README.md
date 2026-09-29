# Docker Compose: Nginx + PHP-FPM + MySQL

Stack completo de desarrollo con tres contenedores interconectados.

## Servicios

- **Nginx** (web): Reverse proxy en puerto 8080
- **PHP-FPM 8.3**: Motor de aplicación
- **MySQL 8.0**: Base de datos

## Estructura

```
project/
├── docker-compose.yml
├── nginx.conf
├── app/
│   └── index.php
├── .dockerignore
└── README.md
```

## Inicio rápido

```bash
docker compose up -d
```

Accede a `http://localhost:8080`

## Credenciales

- **DB User**: root
- **DB Password**: rootpassword
- **DB Name**: myapp
- **DB Host**: db (desde PHP)

## Detener

```bash
docker compose down
```

## Volúmenes

- `db_data`: Almacena datos persistentes de MySQL
- `./app`: Código PHP en el host

## Logs

```bash
docker compose logs -f
```

## Conectar a MySQL

```bash
docker compose exec db mysql -u root -prootpassword myapp
```

## Características

- Red Docker compartida (app-network)
- PDO instalado para conexiones a MySQL
- Nginx configurado como proxy a PHP-FPM
- Base de datos persistente
