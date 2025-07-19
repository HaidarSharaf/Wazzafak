@echo off
echo.
echo 🚀 Setting up your Livewire Auth Starter Kit...
echo ==================================
echo.

REM Check for Composer
where composer >nul 2>nul || (
    echo ❌ Composer not found! Please install Composer before continuing.
    pause
    exit /b
)

REM Check for NPM
where npm >nul 2>nul || (
    echo ❌ Node.js/NPM not found! Please install Node.js before continuing.
    pause
    exit /b
)

REM Copy environment file
if not exist .env (
    copy .env.example .env >nul
    echo ✅ Created .env file
) else (
    echo ⚠️  .env file already exists, skipping...
)

REM Install PHP dependencies
echo 📦 Installing Composer dependencies...
composer install --no-interaction

REM Install Node dependencies
echo 📦 Installing NPM dependencies...
npm install

REM Generate application key
echo 🔑 Generating application key...
php artisan key:generate --force

REM Create storage link
echo 🔗 Creating storage link...
php artisan storage:link

REM Clear caches
echo 🧹 Clearing caches...
php artisan cache:clear
php artisan config:clear
php artisan view:clear

REM Build assets
echo 🎨 Building assets...
npm run build

echo.
echo ✅ Setup complete!
echo.
echo 🔧 Next steps:
echo    1. Run: php artisan migrate
echo    2. Run: php artisan serve
echo.
echo 📚 Check README.md for more information
echo.
pause
