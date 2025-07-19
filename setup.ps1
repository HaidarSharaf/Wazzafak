# PowerShell Setup Script for Livewire Auth Starter Kit

function Check-Command {
    param($command)
    if (-not (Get-Command $command -ErrorAction SilentlyContinue)) {
        Write-Host "❌ '$command' is not installed or not available in PATH." -ForegroundColor Red
        exit 1
    }
}

Check-Command "composer"
Check-Command "npm"
Check-Command "php"

Write-Host ""
Write-Host "🚀 Setting up your Livewire Auth Starter Kit..." -ForegroundColor Cyan
Write-Host "==============================================" -ForegroundColor Cyan
Write-Host ""

# Copy .env file
if (-Not (Test-Path .env)) {
    Copy-Item .env.example .env
    Write-Host "✅ Created .env file" -ForegroundColor Green
} else {
    Write-Host "⚠️  .env file already exists, skipping..." -ForegroundColor Yellow
}

# Install PHP dependencies
Write-Host "📦 Installing Composer dependencies..." -ForegroundColor Blue
composer install --no-interaction

# Install Node dependencies
Write-Host "📦 Installing NPM dependencies..." -ForegroundColor Blue
npm install

# Generate app key
Write-Host "🔑 Generating application key..." -ForegroundColor Blue
php artisan key:generate --force

# Create storage symlink
Write-Host "🔗 Creating storage link..." -ForegroundColor Blue
php artisan storage:link

# Clear Laravel caches
Write-Host "🧹 Clearing caches..." -ForegroundColor Blue
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Build frontend assets
Write-Host "🎨 Building assets..." -ForegroundColor Blue
npm run build

# Final message
Write-Host ""
Write-Host "✅ Setup complete!" -ForegroundColor Green
Write-Host ""
Write-Host "🔧 Next steps:" -ForegroundColor Yellow
Write-Host "   1. Run: php artisan migrate"
Write-Host "   2. Run: php artisan serve"
Write-Host ""
Write-Host "📚 Check README.md for more information"
Write-Host ""
Read-Host "Press Enter to continue..."
