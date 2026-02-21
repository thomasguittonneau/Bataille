FROM php:8.4-cli

# Installation des extensions système nécessaires
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libzip-dev \
    && docker-php-ext-install zip \
    && rm -rf /var/lib/apt/lists/*

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Dossier de travail
WORKDIR /app

# Copie du reste du projet
COPY . .
