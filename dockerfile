# Imagen base oficial de PHP con servidor Apache
FROM php:8.2-apache

# Copiar todos los archivos del repo al contenedor
COPY . /var/www/html/

# Exponer el puerto estándar HTTP
EXPOSE 80
