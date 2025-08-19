@echo off
set LOGFILE=setup.log

echo =======================================================
echo      Asistente de Configuracion para Gym Management
echo =======================================================
echo.
echo Este script instalara las dependencias y configurara el entorno.
echo Se generara un archivo de registro llamado '%LOGFILE%'.
echo.
pause
echo.

del %LOGFILE% 2>nul
echo [INFO] Log de instalacion para Gym Management > %LOGFILE%
echo [INFO] Fecha: %date% %time% >> %LOGFILE%
echo. >> %LOGFILE%

echo --- Limpiando instalacion anterior...
echo --- Limpiando instalacion anterior... >> %LOGFILE%
if exist vendor (
    echo Eliminando directorio 'vendor'...
    rmdir /s /q vendor >> %LOGFILE% 2>&1
)
if exist composer.lock (
    echo Eliminando 'composer.lock'...
    del composer.lock >> %LOGFILE% 2>&1
)
echo Limpieza finalizada.
echo. >> %LOGFILE%

echo --- Paso 1: Instalando dependencias de PHP (Composer)...
echo --- Paso 1: Instalando dependencias de PHP (Composer)... >> %LOGFILE%
call composer install >> %LOGFILE% 2>&1
if %errorlevel% neq 0 (
    echo.
    echo ERROR: 'composer install' fallo. Revisa %LOGFILE% para mas detalles.
    echo [ERROR] 'composer install' fallo. >> %LOGFILE%
    pause
    exit /b %errorlevel%
)
echo Dependencias de PHP instaladas.
echo [SUCCESS] Dependencias de PHP instaladas. >> %LOGFILE%
echo. >> %LOGFILE%

echo --- Paso 2: Instalando dependencias de JS (NPM)...
echo --- Paso 2: Instalando dependencias de JS (NPM)... >> %LOGFILE%
call npm install >> %LOGFILE% 2>&1
if %errorlevel% neq 0 (
    echo.
    echo ERROR: 'npm install' fallo. Revisa %LOGFILE% para mas detalles.
    echo [ERROR] 'npm install' fallo. >> %LOGFILE%
    pause
    exit /b %errorlevel%
)
echo Dependencias de JS instaladas.
echo [SUCCESS] Dependencias de JS instaladas. >> %LOGFILE%
echo. >> %LOGFILE%

echo --- Paso 3: Configurando archivo de entorno .env...
echo --- Paso 3: Configurando archivo de entorno .env... >> %LOGFILE%
if not exist .env (
    copy .env.example .env >> %LOGFILE% 2>&1
    echo Archivo .env creado.
    echo [SUCCESS] Archivo .env creado. >> %LOGFILE%
) else (
    echo El archivo .env ya existe. Omitiendo creacion.
    echo [INFO] El archivo .env ya existe. Omitiendo creacion. >> %LOGFILE%
)
echo. >> %LOGFILE%

echo --- Paso 4: Generando la clave de la aplicacion...
echo --- Paso 4: Generando la clave de la aplicacion... >> %LOGFILE%
php artisan key:generate >> %LOGFILE% 2>&1
if %errorlevel% neq 0 (
    echo.
    echo ERROR: 'php artisan key:generate' fallo. Revisa %LOGFILE% para mas detalles.
    echo [ERROR] 'php artisan key:generate' fallo. >> %LOGFILE%
    pause
    exit /b %errorlevel%
)
echo Clave de aplicacion generada.
echo [SUCCESS] Clave de aplicacion generada. >> %LOGFILE%
echo. >> %LOGFILE%

echo.
echo =======================================================
echo      ACCION MANUAL REQUERIDA
echo =======================================================
echo.
echo Por favor, abre el archivo '.env' en un editor de texto y configura tus
echo credenciales de base de datos.
echo.
pause
echo.

echo --- Paso 5: Ejecutando las migraciones de la base de datos...
echo --- Paso 5: Ejecutando las migraciones de la base de datos... >> %LOGFILE%
php artisan migrate >> %LOGFILE% 2>&1
if %errorlevel% neq 0 (
    echo.
    echo ERROR: 'php artisan migrate' fallo. Revisa %LOGFILE% para mas detalles.
    echo [ERROR] 'php artisan migrate' fallo. >> %LOGFILE%
    pause
    exit /b %errorlevel%
)
echo Migraciones ejecutadas correctamente.
echo [SUCCESS] Migraciones ejecutadas correctamente. >> %LOGFILE%
echo. >> %LOGFILE%

echo --- Paso 6: Creando el enlace simbolico de storage...
echo --- Paso 6: Creando el enlace simbolico de storage... >> %LOGFILE%
php artisan storage:link >> %LOGFILE% 2>&1
echo [INFO] Enlace simbolico de storage creado o ya existente. >> %LOGFILE%
echo. >> %LOGFILE%

echo --- Paso 7: Compilando assets de frontend...
echo --- Paso 7: Compilando assets de frontend... >> %LOGFILE%
call npm run build >> %LOGFILE% 2>&1
if %errorlevel% neq 0 (
    echo.
    echo ERROR: 'npm run build' fallo. Revisa %LOGFILE% para mas detalles.
    echo [ERROR] 'npm run build' fallo. >> %LOGFILE%
    pause
    exit /b %errorlevel%
)
echo Assets compilados.
echo [SUCCESS] Assets compilados. >> %LOGFILE%
echo. >> %LOGFILE%


echo.
echo =======================================================
echo      Configuracion completada con exito!
echo =======================================================
echo.
echo Se ha generado un registro detallado en el archivo '%LOGFILE%'.
echo.
echo Para iniciar el servidor de desarrollo, ejecuta:
echo php artisan serve
echo.
pause
