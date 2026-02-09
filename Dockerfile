# 1. Use PHP 8.2 with Apache
FROM php:8.2-apache

# 2. Install System Dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

# 3. Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# 4. Enable Apache Mod Rewrite
RUN a2enmod rewrite

# 5. Configure Apache Document Root to '/public'
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# =================================================================
#  CRITICAL FIX: Allow .htaccess Overrides
#  This fixes the "404 Not Found" error on routes
# =================================================================
# 6. Change 'AllowOverride None' to 'AllowOverride All'
RUN sed -ri -e 's!AllowOverride None!AllowOverride All!g' /etc/apache2/apache2.conf

# 7. Install PHP Extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 8. Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 9. Set Working Directory
WORKDIR /var/www/html

# =================================================================
#  DEPENDENCY INSTALLATION
# =================================================================

# 10. Copy Composer files FIRST (Better caching)
COPY composer.json composer.lock ./

# 11. Install Dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# =================================================================
#  APPLICATION SETUP
# =================================================================

# 12. Copy the rest of the application code
COPY . .

# 13. Set Permissions (Render needs this)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 14. Expose Port 80
EXPOSE 80

# 15. Start Apache
CMD ["apache2-foreground"]