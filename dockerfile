FROM php:8.2-apache

# Copiar los archivos del proyecto
COPY . /var/www/html/

# Instalar extensiones PHP necesarias (para MySQL y compatibilidad)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Configurar Apache para usar el puerto dinámico asignado por Render
RUN sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf \
    && sed -i 's/:80/:${PORT}/g' /etc/apache2/sites-available/000-default.conf

# Exponer puerto de Render
EXPOSE 10000
ENV PORT=10000

# Iniciar Apache
CMD ["apache2-foreground"]
