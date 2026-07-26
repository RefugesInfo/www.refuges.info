FROM php:8.2-apache

# Dépendances système pour les extensions PHP requises par refuges.info
RUN apt-get update && apt-get install -y --no-install-recommends \
        libpq-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libonig-dev \
        libxml2-dev \
        libzip-dev \
        locales \
    && rm -rf /var/lib/apt/lists/*

# Locale française (utilisée par setlocale/strftime dans includes/config.php)
RUN sed -i 's/# fr_FR.UTF-8/fr_FR.UTF-8/' /etc/locale.gen && locale-gen

# Extensions PHP : pgsql gd mbstring xml opcache zip
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        pdo_pgsql \
        pgsql \
        gd \
        mbstring \
        xml \
        opcache \
        zip

# Apache : mod_rewrite (routing via .htaccess) + AllowOverride All
RUN a2enmod rewrite expires deflate
RUN printf '<Directory /var/www/html>\n    AllowOverride All\n    Require all granted\n</Directory>\n' \
        > /etc/apache2/conf-available/wri-override.conf \
    && a2enconf wri-override

# short_open_tag est utilisé par du vieux code du site
RUN printf 'short_open_tag = On\nupload_max_filesize = 20M\npost_max_size = 25M\n' \
        > /usr/local/etc/php/conf.d/wri.ini
