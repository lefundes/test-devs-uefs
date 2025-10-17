FROM php:8.2-fpm-bullseye
RUN sed -i 's|http://deb.debian.org|https://deb.debian.org|g' /etc/apt/sources.list

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd

# Install Redis PHP extension
RUN pecl install redis && docker-php-ext-enable redis

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u 1000 -d /home/uefs uefs
RUN mkdir -p /home/uefs/.composer && \
    chown -R uefs:uefs /home/uefs

# Set working directory
WORKDIR /var/www

USER uefs
