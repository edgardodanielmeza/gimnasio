@echo off
setlocal

echo =================================================================
echo      Creador de Proyectos Laravel para Gym Management
echo =================================================================
echo.
echo Este script creara una nueva carpeta llamada 'gym-management-system'
echo en el directorio actual y configurara un proyecto de Laravel
echo con Jetstream y Livewire.
echo.
echo Requisitos:
echo - PHP, Composer, Node.js y Git deben estar en el PATH del sistema.
echo.
pause
echo.

echo --- Paso 1: Creando el proyecto de Laravel...
call composer create-project laravel/laravel gym-management-system
if %errorlevel% neq 0 (
    echo. & echo ERROR: 'composer create-project' fallo. Revisa el output. & pause & exit /b %errorlevel%
)
echo.

cd gym-management-system

echo.
echo --- Paso 2: Instalando Laravel Jetstream...
call composer require laravel/jetstream
if %errorlevel% neq 0 (
    echo. & echo ERROR: 'composer require laravel/jetstream' fallo. & pause & exit /b %errorlevel%
)
echo.

echo.
echo --- Paso 3: Instalando el stack de Livewire en Jetstream...
php artisan jetstream:install livewire
if %errorlevel% neq 0 (
    echo. & echo ERROR: 'jetstream:install' fallo. & pause & exit /b %errorlevel%
)
echo.

echo.
echo --- Paso 4: Instalando dependencias de NPM...
call npm install
if %errorlevel% neq 0 (
    echo. & echo ERROR: 'npm install' fallo. & pause & exit /b %errorlevel%
)
echo.

echo.
echo --- Paso 5: Compilando assets de frontend...
call npm run build
if %errorlevel% neq 0 (
    echo. & echo ERROR: 'npm run build' fallo. & pause & exit /b %errorlevel%
)
echo.

echo.
echo --- Paso 6: Configurando archivo de entorno .env...
if not exist .env (
    copy .env.example .env
)
php artisan key:generate
echo.

echo.
echo =======================================================
echo      ACCION MANUAL REQUERIDA
echo =======================================================
echo.
echo Por favor, abre el archivo '.env' en la carpeta 'gym-management-system'
echo y configura tus credenciales de base de datos.
echo.
echo Luego, crea una base de datos vacia con ese nombre.
echo.
pause
echo.

echo.
echo --- Paso 7: Ejecutando las migraciones iniciales...
php artisan migrate
if %errorlevel% neq 0 (
    echo. & echo ERROR: 'php artisan migrate' fallo. & pause & exit /b %errorlevel%
)
echo.

echo.
echo =================================================================
echo      ¡Proyecto base creado con exito!
echo =================================================================
echo.
echo El siguiente paso sera que yo te proporcione las funcionalidades
echo especificas del gimnasio.
echo.
pause
endlocal
