# Usando a imagem oficial do PHP com Apache
FROM php:8.2-apache

# Instalar dependências do PHP e do sistema
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libzip-dev unzip libicu-dev curl git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip intl

# Instalar o Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia apenas os arquivos de configuração do Composer primeiro
COPY composer.json composer.lock ./

# Instala as dependências do Laravel
RUN composer install --no-scripts --no-autoloader

# Copia o resto dos arquivos do Laravel
COPY . .

# Configura o ambiente
RUN cp .env.example .env && \
    php artisan key:generate --force && \
    composer dump-autoload --optimize

# Configura o Apache para servir a pasta 'public' do Laravel
RUN echo 'ServerName localhost' >> /etc/apache2/apache2.conf
COPY ./docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Habilita o mod_rewrite do Apache
RUN a2enmod rewrite

# Permissão para a pasta de cache e logs do Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/vendor /var/www/html/.env

# Expondo a porta 80
EXPOSE 80

# Copia script de inicialização
COPY ./docker/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

# Comando de inicialização
CMD ["start.sh"]
