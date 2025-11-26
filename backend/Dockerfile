FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite3 \
    libsqlite3-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_sqlite mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first for better caching
COPY composer.json ./

# Install dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-scripts

# Copy the rest of the application
COPY . .

# Create .env file from environment variables
RUN echo 'APP_NAME="ZenRows Configuration Selector"' > .env && \
    echo 'APP_ENV=local' >> .env && \
    echo 'APP_KEY=' >> .env && \
    echo 'APP_DEBUG=true' >> .env && \
    echo 'APP_TIMEZONE=UTC' >> .env && \
    echo 'APP_URL=http://localhost:8000' >> .env && \
    echo 'DB_CONNECTION=sqlite' >> .env && \
    echo 'DB_DATABASE=/var/www/html/database/database.sqlite' >> .env && \
    echo 'LOG_CHANNEL=stack' >> .env && \
    echo 'LOG_LEVEL=debug' >> .env

# Create SQLite database file and directories
RUN mkdir -p database storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache
RUN touch database/database.sqlite

# Set permissions
RUN chmod -R 775 storage bootstrap/cache database
RUN chown -R www-data:www-data storage bootstrap/cache database

# Generate application key
RUN php artisan key:generate --force

# Regenerate autoloader with scripts
RUN composer dump-autoload

# Expose port 8000
EXPOSE 8000

# Start Laravel's built-in server with migrations and seeding
CMD php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=8000
