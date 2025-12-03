FROM ubuntu:latest

ARG DEBIAN_FRONTEND=noninteractive

# Instalar PHP 8.4 y dependencias
RUN apt-get update && \
    apt-get install -y software-properties-common curl unzip git && \
    add-apt-repository ppa:ondrej/php -y && \
    apt-get update && \
    apt-get install -y php8.4 php8.4-cli php8.4-mbstring php8.4-xml php8.4-curl php8.4-zip && \
    rm -rf /var/lib/apt/lists/*

# Composer
RUN curl -sS https://getcomposer.org/installer | php \
    -- --install-dir=/usr/local/bin \
    --filename=composer

WORKDIR /var/www/html
EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
