#!/bin/bash

# ZenRows Configuration Selector - Local Development Setup Script (Bash)
# Run this if you prefer to run the application locally without Docker

set -e

echo "=== ZenRows Configuration Selector Setup ==="

# Check for PHP
echo -e "\nChecking PHP..."
if command -v php &> /dev/null; then
    echo "PHP found: $(php -v | head -n 1)"
else
    echo "PHP not found. Please install PHP 8.2+"
    exit 1
fi

# Check for Composer
echo -e "\nChecking Composer..."
if command -v composer &> /dev/null; then
    echo "Composer found"
else
    echo "Composer not found. Please install Composer"
    exit 1
fi

# Check for Node.js
echo -e "\nChecking Node.js..."
if command -v node &> /dev/null; then
    echo "Node.js found: $(node -v)"
else
    echo "Node.js not found. Please install Node.js 18+"
    exit 1
fi

# Setup Backend
echo -e "\n=== Setting up Backend ==="
cd backend

# Create .env file
echo "Creating .env file..."
cat > .env << 'EOF'
APP_NAME="ZenRows Configuration Selector"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost:8000

LOG_CHANNEL=stack
LOG_STACK=single
LOG_LEVEL=debug

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
EOF

# Install PHP dependencies
echo "Installing PHP dependencies..."
composer install --no-interaction

# Create database
echo "Creating SQLite database..."
mkdir -p database
touch database/database.sqlite

# Generate app key
echo "Generating application key..."
php artisan key:generate

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Seed database
echo "Seeding database..."
php artisan db:seed --force

cd ..

# Setup Frontend
echo -e "\n=== Setting up Frontend ==="
cd frontend

echo "Installing Node.js dependencies..."
npm install

cd ..

echo -e "\n=== Setup Complete! ==="
echo "To start the application:"
echo "  1. In terminal 1: cd backend && php artisan serve"
echo "  2. In terminal 2: cd frontend && npm run dev"
echo ""
echo "Then open http://localhost:5173 in your browser"

