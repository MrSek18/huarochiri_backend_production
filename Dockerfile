FROM php:8.2-cli

# Instala dependencias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    nano \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring zip

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia el proyecto
COPY . /var/www/html
WORKDIR /var/www/html

# Instala dependencias Laravel
RUN composer install --no-dev --optimize-autoloader

# Da permisos
RUN chmod -R 755 storage bootstrap/cache

# Variables de entorno
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV APP_KEY=base64:Owq9OvBUo+ABj7+y34gJCD53aeCnH0u/Arw+QUEPtac=
ENV DB_CONNECTION=mysql
ENV DB_HOST=sqlXXX.infinityfree.com
ENV DB_PORT=3306
ENV DB_DATABASE=ep_tunombre_db
ENV DB_USERNAME=ep_tuusuario
ENV DB_PASSWORD=tu_contraseña

# Expone el puerto
EXPOSE 8000

# Comando de arranque
CMD php artisan serve --host=0.0.0.0 --port=8000
