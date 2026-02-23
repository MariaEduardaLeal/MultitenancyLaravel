# 1. Definimos a base da nossa cápsula (água do mar limpa)
FROM php:8.3-fpm

# 2. Onde o "camarão" (seu código) vai morar lá dentro
WORKDIR /var/www

# 3. Instalamos as ferramentas que o Linux precisa para o Laravel nadar
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev \
    libonig-dev

# 4. Instalamos as extensões do PHP que o Laravel exige
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# 5. Pegamos o "mestre das dependências" (Composer) de outra cápsula pronta
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6. Copiamos os arquivos do seu PC para dentro da cápsula
COPY . /var/www

# 7. Damos permissão para o Laravel conseguir escrever nas pastas de fotos e logs
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# 8. Porta que a cápsula vai usar para conversar
EXPOSE 9000

# 9. Comando que liga o motor do PHP quando a cápsula iniciar
CMD ["php-fpm"]
