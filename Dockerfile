# 1. Use PHP 8.2 with Apache (Best for Render/Single Container)
FROM php:8.2-apache

# 2. Install System Dependencies (Required for Composer & Extensions)
# We add 'zip', 'unzip', 'git', and 'curl' here to fix your previous error.
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

# 3. Clear cache to keep the image small
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# 4. Enable Apache Mod Rewrite (Crucial for Laravel Routes)
RUN a2enmod rewrite

# 5. Configure Apache Document Root to '/public'
# Laravel serves files from /public, not the root.
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 6. Install PHP Extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 7. Get Composer (The latest version)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 8. Set Working Directory
WORKDIR /var/www/html

# =================================================================
#  DEPENDENCY INSTALLATION
# =================================================================

# 9. Copy Composer files FIRST
# This allows Docker to cache dependencies if these files haven't changed.
COPY composer.json composer.lock ./

# 10. Install Dependencies
# --no-dev: Don't install testing tools (phpunit, faker, etc.) for production
# --no-scripts: Don't run artisan commands yet (we don't have the code or DB)
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# =================================================================
#  APPLICATION SETUP
# =================================================================

# 11. Copy the rest of the application code
COPY . .

# 12. Set Permissions
# Render/Apache needs permission to write to these folders.
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 13. Expose Port 80 (Standard Web Port)
EXPOSE 80

# 14. Start Apache
CMD ["apache2-foreground"]