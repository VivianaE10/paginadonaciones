# Usa la misma imagen base que estabas usando antes
FROM php:8.2-apache

# Instala la extensión mysqli
# docker-php-ext-configure mysqli --with-mysqli=mysqlnd (opcional, mysqlnd suele ser el default y es recomendado)
RUN docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli

# Opcional: Si necesitas otras extensiones o herramientas, instálalas aquí.
# Por ejemplo, para pdo_mysql:
# RUN docker-php-ext-install pdo_mysql \
# && docker-php-ext-enable pdo_mysql

# Opcional: Actualizar paquetes e instalar dependencias del sistema si alguna extensión las requiere.
# RUN apt-get update && apt-get install -y \
#       libzip-dev \
#       zip \
#    && docker-php-ext-install zip \
#    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Apache expone el puerto 80 por defecto, esto es más bien documentación.
EXPOSE 80

# El CMD por defecto de php:X.X-apache es apache2-foreground, no necesitas re-declararlo usualmente.