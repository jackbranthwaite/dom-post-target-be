FROM php:8.1.10-fpm

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/

# Set working directory
WORKDIR /var/www

RUN curl -sL https://deb.nodesource.com/setup_10.x | bash -

# Install dependencies
RUN apt-get update && apt-get install -y \
    curl \
    git \
    libpng-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libldap2-dev \
    libxml2-dev \
    libzip-dev \
    mariadb-client \
    python2 \
    sqlite3

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN pecl install redis
RUN docker-php-ext-install pdo_mysql zip bcmath soap intl ldap gd
RUN docker-php-ext-enable redis

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
