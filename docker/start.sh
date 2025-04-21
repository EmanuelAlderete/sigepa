#!/bin/bash

# Espera o banco de dados subir (ajuste conforme necessário)
echo "Aguardando o banco de dados..."
sleep 10

# Roda migrações e seeders com --force para ambientes não interativos
<<<<<<< HEAD
=======
php artisan key:generate
>>>>>>> 42e4c50 (refactor(docker): update docker-compose configuration and modify permissions for .gitignore files)
php artisan migrate --force
php artisan db:seed --force

# Inicia o Apache
apache2-foreground
