# PHP 8.4 : le code du site utilise des syntaxes 8.4 (ex. new X()->methode()
# dans controlleurs/api/points.php). L'INSTALL.md mentionne 8.2 mais est obsolète.
FROM php:8.4-apache

# Dépendances système pour les extensions PHP requises par refuges.info
RUN apt-get update && apt-get install -y --no-install-recommends \
        libpq-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libonig-dev \
        libxml2-dev \
        libzip-dev \
        libicu-dev \
        locales \
    && rm -rf /var/lib/apt/lists/*

# Locale française (utilisée par setlocale/strftime dans includes/config.php)
RUN sed -i 's/# fr_FR.UTF-8/fr_FR.UTF-8/' /etc/locale.gen && locale-gen

# Extensions PHP : pgsql gd mbstring xml opcache zip intl
# (intl est requis par includes/mise_en_forme_texte.php -> IntlDateFormatter)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        pdo_pgsql \
        pgsql \
        gd \
        mbstring \
        xml \
        opcache \
        zip \
        intl

# Apache : mod_rewrite (routing via .htaccess) + AllowOverride All
RUN a2enmod rewrite expires deflate
RUN printf '<Directory /var/www/html>\n    AllowOverride All\n    Require all granted\n</Directory>\n' \
        > /etc/apache2/conf-available/wri-override.conf \
    && a2enconf wri-override

# Config PHP du site :
# - short_open_tag : utilisé par du vieux code du site
# - output_buffering : indispensable car des vues (ex. vues/style.css.php) émettent
#   du contenu avant leur appel header('content-type: text/css'). Sans buffer, le
#   Content-Type reste text/html et les CSS ne s'appliquent pas (comportement de prod).
RUN printf 'short_open_tag = On\noutput_buffering = 4096\nupload_max_filesize = 20M\npost_max_size = 25M\n' \
        > /usr/local/etc/php/conf.d/wri.ini
