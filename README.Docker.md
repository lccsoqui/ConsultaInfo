# Docker Setup para Consulta Información

## Requisitos Previos

- Docker instalado
- Docker Compose instalado

## Configuración Inicial

1. **Copiar y configurar el archivo de entorno:**

   ```bash
   cp .env.example .env
   ```

2. **Editar el archivo `.env` con tus credenciales:**

   ```dotenv
   DB_SERVER=172.29.3.16
   DB_NAME=CEE_MASTER
   DB_USER=tu_usuario
   DB_PASSWORD=tu_password
   DB_CHARSET=UTF-8
   DB_ENCRYPT=true
   DB_TRUST_CERT=true

   ADMIN_USER=tu_usuario_admin
   ADMIN_PASSWORD=tu_password_admin
   ```

## Comandos Docker

### Construir y levantar los contenedores

```bash
docker-compose up -d --build
```

### Ver logs

```bash
docker-compose logs -f
```

### Detener los contenedores

```bash
docker-compose down
```

### Reiniciar los contenedores

```bash
docker-compose restart
```

### Acceder al contenedor

```bash
docker exec -it consultainfo-web bash
```

## Acceso a la Aplicación

Una vez que los contenedores estén corriendo, accede a:

- **URL:** http://localhost:8080
- **Login:** Usar las credenciales configuradas en `.env` (ADMIN_USER y ADMIN_PASSWORD)

## Estructura de Puertos

- **8080** → Aplicación web (Apache/PHP)

## Notas Importantes

1. **Conectividad SQL Server:** Asegúrate de que el contenedor pueda acceder al servidor SQL Server en `172.29.3.16`. Si está en una red diferente, puede ser necesario configurar networking adicional.

2. **Volúmenes:** El código fuente está montado como volumen, por lo que los cambios se reflejan inmediatamente sin necesidad de reconstruir la imagen.

3. **Logs:** Los logs de Apache se guardan en la carpeta `./logs/`

4. **Permisos:** Si tienes problemas de permisos, puedes ejecutar:
   ```bash
   docker exec consultainfo-web chown -R www-data:www-data /var/www/html
   ```

## Troubleshooting

### Error de conexión a SQL Server

Si hay problemas de conexión, verifica:

1. Que el servidor SQL Server permite conexiones remotas
2. Que el firewall permite el puerto 1433
3. Que las credenciales en `.env` son correctas

### Ver logs de PHP

```bash
docker exec consultainfo-web tail -f /var/log/apache2/error.log
```

### Reconstruir la imagen

Si haces cambios en el Dockerfile:

```bash
docker-compose down
docker-compose build --no-cache
docker-compose up -d
```
