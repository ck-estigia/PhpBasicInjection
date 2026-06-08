# PhpEnv Demo

Este repositorio contiene un entorno PHP sencillo basado en Docker para una demo de inicio de sesión que ilustra una vulnerabilidad de inyección SQL.

## Estructura del proyecto

- `docker-compose.yml` - Define los servicios para MySQL, phpMyAdmin y la aplicación web PHP.
- `dockerfile` - Construye un contenedor PHP 8.3 con Apache y soporte PDO MySQL.
- `www/index.php` - Formulario de login con construcción de consulta SQL intencionadamente insegura.
- `sql-injection.sql` - Script SQL de ejemplo para crear la base de datos `sqlInjection` y datos de muestra en `Usuarios` / `Productos`.
- `vagrantfile` - Configuración de aprovisionamiento para ejecutar Docker dentro de una VM Ubuntu en VirtualBox.

## Requisitos

- Docker
- Docker Compose
- Opcional: Vagrant y VirtualBox si se utiliza el `vagrantfile`

## Instalación y ejecución

### Usando Docker Compose

1. Inicia los servicios:

```bash
docker compose up -d
```

2. Abre la aplicación en el navegador:

- App: `http://localhost:8090`
- phpMyAdmin: `http://localhost:8088`

### Usando Vagrant

1. Ejecuta:

```bash
vagrant up
```

2. El `Vagrantfile` reenvía los mismos puertos:

- App: `http://localhost:8090`
- phpMyAdmin: `http://localhost:8088`
- MySQL: `localhost:3310`

## Notas de la base de datos

La aplicación PHP usa la base de datos `sqlInjection` y la tabla `Usuarios`. El script `sql-injection.sql` crea esta base de datos y carga usuarios de ejemplo.

> Nota: El archivo `docker-compose.yml` define actualmente la base de datos MySQL como `appdb`, mientras que la aplicación PHP se conecta a `sqlInjection`. Actualiza la configuración del contenedor MySQL o la conexión de la aplicación si quieres que coincidan.

## Credenciales

- Usuario root de MySQL: `root`
- Contraseña root de MySQL: `rootpassword`
- Usuario no root de MySQL: `sa`
- Contraseña de MySQL: `abc123s`

## Advertencia de seguridad

Este proyecto demuestra intencionadamente un manejo inseguro de SQL.

- `www/index.php` construye SQL usando entrada de usuario sin escapar.
- Esto es vulnerable a inyección SQL.

No uses este código en producción.
