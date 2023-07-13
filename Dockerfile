FROM php:8.0.2-fpm


# Set working directory
WORKDIR /var/www/html


# This is done before installing composer(Install all prerequisite packages)
RUN apk update
RUN curl -sS https://getcomposer.org/installer | php -- --version=8.0.2 --install-dir=/usr/local/bin --filename=composer

# Copy everything from our folder into the docker image
COPY . .

# Install system dependencies
RUN composer update && composer install


# Clear cache
# RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
# RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
# RUN useradd -G www-data,root -u $uid -d /home/$user $user
# RUN mkdir -p /home/$user/.composer && \
#     chown -R $user:$user /home/$user


# USER $user

# Define the entry point of the app
CMD [ "php artisan serve --host=0.0.0.0" ]
