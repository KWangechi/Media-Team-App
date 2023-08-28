FROM php:8.2-cli


# This is done before installing composer(Install all prerequisite packages)
RUN apt-get update -y
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /my_apps

# Copy everything from our folder into the docker image
COPY . .

# Install system dependencies
RUN composer install
# Expose this container to be accessible via the web
EXPOSE 8080
CMD [ "php artisan serve --host=0.0.0.0 --port=8080" ]
