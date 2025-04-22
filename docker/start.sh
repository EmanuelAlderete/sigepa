#!/bin/bash

# Espera o banco de dados subir (ajuste conforme necessário)
echo "Aguardando o banco de dados..."
sleep 10

# Garante que temos uma chave de aplicação válida
if [ -z "$(grep '^APP_KEY=' .env)" ]; then
    php artisan key:generate --force
fi

# Roda migrações e seeders com --force para ambientes não interativos
php artisan migrate --force
php artisan db:seed --force

# Limpa o cache da configuração e das rotas
php artisan config:clear
php artisan route:clear
php artisan cache:clear

# Inicia o Apache
apache2-foreground
