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

# Locales : fr_FR est utilisée par setlocale/strftime dans includes/config.php ; les autres sont prévues pour la
# traduction du site (gettext exige que la locale de chaque langue soit générée dans le système).
# Langues prévues : français, anglais (en_GB), allemand, italien, espagnol.
RUN for l in fr_FR de_DE en_GB it_IT es_ES; do sed -i "s/^# $l.UTF-8/$l.UTF-8/" /etc/locale.gen; done \
    && locale-gen

# Extensions PHP : pgsql gd mbstring xml opcache zip intl exif gettext
# (exif est requis par modeles/commentaire.php -> exif_imagetype/exif_read_data à l'ajout d'une photo)
# (gettext : pas encore utilisé, prévu pour la traduction du site ; présent aussi sur le serveur de prod)
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
        intl \
        exif \
        gettext

# Apache : mod_rewrite (routing via .htaccess) + AllowOverride All
RUN a2enmod rewrite expires deflate
RUN printf '<Directory /var/www/html>\n    AllowOverride All\n    Require all granted\n</Directory>\n' \
        > /etc/apache2/conf-available/wri-override.conf \
    && a2enconf wri-override

# Config PHP du site :
# - short_open_tag : Off explicite, car sans php.ini (cas de cette image) le défaut compilé de PHP est On.
#   Le code n'utilise plus les balises courtes "<?" et les vues d'export commencent par <?xml
# - output_buffering : indispensable car des vues (ex. vues/style.css.php) émettent
#   du contenu avant leur appel header('content-type: text/css'). Sans buffer, le
#   Content-Type reste text/html et les CSS ne s'appliquent pas (comportement de prod).
# - auto_globals_jit : Off, sinon $_REQUEST arrive vide aux contrôleurs (formulaire d'ajout de point qui affiche
#   "vous n'auriez pas dû arriver ici", sans aucune erreur). Sans php.ini PHP garde On : $_REQUEST n'est alors construit
#   que si un fichier déjà compilé le cite, et phpBB (identification.php, enable_super_globals) restaure la copie vide
#   capturée à son chargement.
# - display_errors + log_errors : image destinée au développement, les erreurs PHP sont affichées dans la page ET écrites
#   dans le log d'Apache (donc visibles avec `make logs`). Sans php.ini, log_errors vaut Off : une erreur fatale qui vide
#   la page ne laissait alors aucune trace.
RUN printf 'short_open_tag = Off\noutput_buffering = 4096\nupload_max_filesize = 20M\npost_max_size = 25M\nauto_globals_jit = Off\ndisplay_errors = On\nlog_errors = On\n' \
        > /usr/local/etc/php/conf.d/wri.ini
