FROM php:8.2-apache

# 1. Install dependencies (including MySQL and Zip)
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql zip

# 2. Enable Apache mod_rewrite
RUN a2enmod rewrite

# 3. Set the working directory
WORKDIR /var/www/html

# 4. Install System Dependencies (Required for Composer)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache to keep image small
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 5. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# --- FIX IS HERE ---
# You must copy the composer files BEFORE running install
COPY composer.json composer.lock ./

# Now run the install
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-plugins

# 6. Set Permissions (Crucial for 500 Errors)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 7. Configure Apache Document Root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 8. THE MISSING PIECE: The Start Command
# This runs automatically when Render starts your app.
# It (A) Fixes the database, then (B) Starts the server.
CMD sh -c "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT}"