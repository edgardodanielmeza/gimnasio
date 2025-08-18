@echo off
echo.
echo =======================================================
echo      Asistente de Configuracion para Gym Management
echo =======================================================
echo.
echo Este script instalara las dependencias y configurara el entorno.
echo Asegurate de ejecutarlo DESDE el directorio del proyecto:
echo C:\wamp64\www\gym-management-system
echo.
echo Asegurate de que Git, Composer, PHP y Node.js esten en el PATH del sistema.
echo.
pause
echo.

echo.
echo --- Limpiando instalacion anterior (si existe)...
if exist vendor (
    echo Eliminando directorio 'vendor'...
    rmdir /s /q vendor
)
if exist composer.lock (
    echo Eliminando 'composer.lock'...
    del composer.lock
)
echo Limpieza finalizada.
echo.

echo.
echo --- Paso 1: Instalando dependencias de PHP (Composer)...
composer install
if %errorlevel% neq 0 (
    echo.
    echo ERROR: 'composer install' fallo. Por favor, revisa el output.
    pause
    exit /b %errorlevel%
)
echo Dependencias de PHP instaladas.
echo.

echo.
echo --- Paso 2: Instalando dependencias de JS (NPM)...
npm install
if %errorlevel% neq 0 (
    echo.
    echo ERROR: 'npm install' fallo. Por favor, revisa el output.
    pause
    exit /b %errorlevel%
)
echo Dependencias de JS instaladas.
echo.

echo.
echo --- Paso 3: Configurando archivo de entorno .env...
if not exist .env (
    copy .env.example .env
    echo Archivo .env creado.
) else (
    echo El archivo .env ya existe. Omitiendo creacion.
)
echo.

echo.
echo --- Paso 4: Generando la clave de la aplicacion...
php artisan key:generate
if %errorlevel% neq 0 (
    echo.
    echo ERROR: 'php artisan key:generate' fallo.
    pause
    exit /b %errorlevel%
)
echo Clave de aplicacion generada.
echo.

echo.
echo =======================================================
echo      ACCION MANUAL REQUERIDA
echo =======================================================
echo.
echo Por favor, abre el archivo '.env' en un editor de texto y configura tus
echo credenciales de base de datos.
echo.
echo Ejemplo:
echo DB_DATABASE=gym_management
echo DB_USERNAME=root
echo DB_PASSWORD=
echo.
echo Luego, crea una base de datos vacia con el nombre que especificaste
echo (ej. 'gym_management') desde phpMyAdmin o tu cliente de MySQL preferido.
echo.
pause
echo.

echo.
echo --- Paso 5: Ejecutando las migraciones de la base de datos...
php artisan migrate
if %errorlevel% neq 0 (
    echo.
    echo ERROR: 'php artisan migrate' fallo.
    echo Asegurate de que la base de datos fue creada y las credenciales en .env son correctas.
    pause
    exit /b %errorlevel%
)
echo Migraciones ejecutadas correctamente.
echo.

echo.
echo --- Paso 6: Creando el enlace simbolico de storage...
php artisan storage:link
echo.

echo.
echo --- Paso 7: Compilando assets de frontend...
npm run build
if %errorlevel% neq 0 (
    echo.
    echo ERROR: 'npm run build' fallo.
    pause
    exit /b %errorlevel%
)
echo Assets compilados.
echo.

echo.
echo =======================================================
echo      Configuracion completada con exito!
echo =======================================================
echo.
echo Para iniciar el servidor de desarrollo, ejecuta:
echo php artisan serve
echo.
pause
