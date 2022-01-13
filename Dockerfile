FROM php:7.4-fpm

# install required packages
RUN apt-get update && apt-get install -y \
    git \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    --with-freetype=/usr/include/ \
    --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

# install php extensions
RUN docker-php-ext-install pdo_mysql exif pcntl bcmath zip

# install nodejs
RUN apt-get install -y software-properties-common
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -
RUN apt-get -y install nodejs

ENV APP_DIR=/app

RUN mkdir ${APP_DIR}

WORKDIR ${APP_DIR}

ENV UID 1000
ENV USER cynax

RUN useradd -G www-data,root -u ${UID} -d /home/${USER} ${USER}

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN mkdir -p /home/${USER}/.composer && \
    chown -R ${USER}:${USER} /home/${USER}

USER ${USER}
