FROM php:8.1-apache

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    curl \
    gnupg \
    apt-transport-https \
    unixodbc \
    unixodbc-dev \
    && rm -rf /var/lib/apt/lists/*

# Agregar Microsoft repository para ODBC Driver
RUN curl -fsSL https://packages.microsoft.com/keys/microsoft.asc | gpg --dearmor -o /usr/share/keyrings/microsoft-prod.gpg \
    && curl https://packages.microsoft.com/config/debian/12/prod.list | tee /etc/apt/sources.list.d/mssql-release.list

# Instalar ODBC Driver para SQL Server
RUN apt-get update \
    && ACCEPT_EULA=Y apt-get install -y msodbcsql18 \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Instalar sqlsrv y pdo_sqlsrv
RUN pecl install sqlsrv pdo_sqlsrv \
    && docker-php-ext-enable sqlsrv pdo_sqlsrv

# Habilitar módulos de Apache
RUN a2enmod rewrite headers

# Configurar DocumentRoot
ENV APACHE_DOCUMENT_ROOT /var/www/html

# Actualizar configuración de Apache
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Configurar PHP
RUN echo "upload_max_filesize = 50M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = 50M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "max_execution_time = 1200" >> /usr/local/etc/php/conf.d/timeouts.ini \
    && echo "max_input_time = 1200" >> /usr/local/etc/php/conf.d/timeouts.ini \
    && echo "memory_limit = 128M" >> /usr/local/etc/php/conf.d/memory.ini

# Copiar archivos de la aplicación
COPY . /var/www/html/

# Asegurar que .env existe
RUN if [ ! -f /var/www/html/.env ]; then \
        cp /var/www/html/.env.example /var/www/html/.env; \
    fi

WORKDIR /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
