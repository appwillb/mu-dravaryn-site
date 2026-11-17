FROM php:7.4-apache

# Use official extension installer (automatically handles Debian EOL repository archives)
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions gd pdo_pgsql pgsql

# PHP configuration for MuSite compatibility
RUN echo "short_open_tag = On" > /usr/local/etc/php/conf.d/musite.ini \
    && echo "display_errors = Off" >> /usr/local/etc/php/conf.d/musite.ini \
    && echo "error_reporting = E_ALL & ~E_DEPRECATED & ~E_NOTICE & ~E_WARNING" >> /usr/local/etc/php/conf.d/musite.ini \
    && echo "memory_limit = 256M" >> /usr/local/etc/php/conf.d/musite.ini

RUN a2enmod rewrite

COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html/

EXPOSE 80
CMD ["apache2-foreground"]
