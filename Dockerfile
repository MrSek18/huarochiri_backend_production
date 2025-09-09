FROM richarvey/nginx-php-fpm:latest

# Copia todo el proyecto al contenedor
COPY . /var/www/html

# Establece el directorio raíz
WORKDIR /var/www/html

# Instala dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Establece variables de entorno
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV APP_KEY=base64:base64:Owq9OvBUo+ABj7+y34gJCD53aeCnH0u/Arw+QUEPtac=
ENV DB_CONNECTION=mysql
ENV DB_HOST=sqlXXX.infinityfree.com
ENV DB_PORT=3306
ENV DB_DATABASE=ep_tunombre_db
ENV DB_USERNAME=ep_tuusuario
ENV DB_PASSWORD=tu_contraseña

# Expone el puerto
EXPOSE 80
