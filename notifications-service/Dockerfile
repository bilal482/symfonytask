FROM php:8.2-cli

# Install dependencies and extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    libpq-dev \
    libzip-dev \
    zip \
    librabbitmq-dev \
    && docker-php-ext-install intl pdo pdo_mysql \
    && docker-php-ext-install pcntl \
    && pecl install amqp \
    && docker-php-ext-enable amqp

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

WORKDIR /app
COPY . .

# Set COMPOSER_ALLOW_SUPERUSER to allow running Composer as root
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN composer install

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
