# ZenRows Configuration Selector - Local Development Setup Script (PowerShell)
# Run this if you prefer to run the application locally without Docker

Write-Host "=== ZenRows Configuration Selector Setup ===" -ForegroundColor Green

# Check for PHP
Write-Host "`nChecking PHP..." -ForegroundColor Yellow
$php = Get-Command php -ErrorAction SilentlyContinue
if ($php) {
    Write-Host "PHP found: $(php -v | Select-Object -First 1)" -ForegroundColor Green
} else {
    Write-Host "PHP not found. Please install PHP 8.2+" -ForegroundColor Red
    exit 1
}

# Check for Composer
Write-Host "`nChecking Composer..." -ForegroundColor Yellow
$composer = Get-Command composer -ErrorAction SilentlyContinue
if ($composer) {
    Write-Host "Composer found" -ForegroundColor Green
} else {
    Write-Host "Composer not found. Please install Composer" -ForegroundColor Red
    exit 1
}

# Check for Node.js
Write-Host "`nChecking Node.js..." -ForegroundColor Yellow
$node = Get-Command node -ErrorAction SilentlyContinue
if ($node) {
    Write-Host "Node.js found: $(node -v)" -ForegroundColor Green
} else {
    Write-Host "Node.js not found. Please install Node.js 18+" -ForegroundColor Red
    exit 1
}

# Setup Backend
Write-Host "`n=== Setting up Backend ===" -ForegroundColor Green
Set-Location backend

# Create .env file
Write-Host "Creating .env file..." -ForegroundColor Yellow
@"
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
"@ | Out-File -FilePath .env -Encoding UTF8

# Install PHP dependencies
Write-Host "Installing PHP dependencies..." -ForegroundColor Yellow
composer install --no-interaction

# Create database
Write-Host "Creating SQLite database..." -ForegroundColor Yellow
New-Item -ItemType Directory -Force -Path database | Out-Null
New-Item -ItemType File -Force -Path database/database.sqlite | Out-Null

# Generate app key
Write-Host "Generating application key..." -ForegroundColor Yellow
php artisan key:generate

# Run migrations
Write-Host "Running migrations..." -ForegroundColor Yellow
php artisan migrate --force

# Seed database
Write-Host "Seeding database..." -ForegroundColor Yellow
php artisan db:seed --force

Set-Location ..

# Setup Frontend
Write-Host "`n=== Setting up Frontend ===" -ForegroundColor Green
Set-Location frontend

Write-Host "Installing Node.js dependencies..." -ForegroundColor Yellow
npm install

Set-Location ..

Write-Host "`n=== Setup Complete! ===" -ForegroundColor Green
Write-Host "To start the application:"
Write-Host "  1. In terminal 1: cd backend && php artisan serve"
Write-Host "  2. In terminal 2: cd frontend && npm run dev"
Write-Host "`nThen open http://localhost:5173 in your browser"

