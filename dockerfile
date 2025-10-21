FROM php:8.2-apache

# Copiar los archivos del proyecto
COPY . /var/www/html/

# Configurar Apache para usar el puerto dinámico de Render ($PORT)
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf

# Exponer la variable de entorno
ENV PORT=10000

# Comando de inicio
CMD ["apache2-foreground"]
