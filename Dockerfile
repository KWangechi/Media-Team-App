FROM php:8.2-cli


# This is done before installing composer(Install all prerequisite packages)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# install -  PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

#Need to import the mysql service and copy the .env file for the DB config

# Copy everything from our folder into the docker image
COPY . /my_apps

# Set working directory
WORKDIR /my_apps


# Install system dependencies
RUN composer install

#migrate the database table with seeded data
RUN php artisan migrate --seed

# Expose this container to be accessible via the web
EXPOSE 8080


# Run the application
CMD [ "php" "artisan serve"]
