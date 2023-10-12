# Use an official PHP runtime as the base image
FROM php:8.2-fpm

# Set the working directory in the container
WORKDIR /var/www/html

# Copy your application files into the container
COPY . /var/www/html

# Expose the port that your PHP application listens on (e.g., 9000)
EXPOSE 9000

# Start your PHP application
CMD ["php-fpm"]