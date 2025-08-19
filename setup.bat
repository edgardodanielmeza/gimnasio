@echo off
setlocal
set LOGFILE=setup.log

:MENU
cls
echo =======================================================
echo      Asistente de Configuracion para Gym Management
echo =======================================================
echo.
echo Selecciona una opcion:
echo.
echo   [0] Ejecutar todos los pasos (Instalacion automatica)
echo   -------------------------------------------------------
echo   [1] Limpiar instalacion anterior (borra /vendor y .lock)
echo   [2] Instalar dependencias de PHP (Composer)
echo   [3] Instalar dependencias de JS (NPM)
echo   [4] Configurar archivo .env y generar clave
echo   [5] Ejecutar migraciones de la base de datos
echo   [6] Crear enlace simbolico de storage
echo   [7] Compilar assets de frontend (npm run build)
echo.
echo   [8] Salir
echo.

CHOICE /C 012345678 /N /M "Elige una opcion:"

IF ERRORLEVEL 9 GOTO SALIR
IF ERRORLEVEL 8 GOTO STEP7_CALL
IF ERRORLEVEL 7 GOTO STEP6_CALL
IF ERRORLEVEL 6 GOTO STEP5_CALL
IF ERRORLEVEL 5 GOTO STEP4_CALL
IF ERRORLEVEL 4 GOTO STEP3_CALL
IF ERRORLEVEL 3 GOTO STEP2_CALL
IF ERRORLEVEL 2 GOTO STEP1_CALL
IF ERRORLEVEL 1 GOTO ALL_STEPS_CALL

:ALL_STEPS_CALL
CALL :STEP1
CALL :STEP2
CALL :STEP3_AND_4
CALL :STEP_MANUAL_DB
CALL :STEP5
CALL :STEP6
CALL :STEP7
CALL :SUCCESS_ALL
GOTO MENU

:STEP1_CALL
CALL :STEP1
pause
GOTO MENU

:STEP2_CALL
CALL :STEP2
pause
GOTO MENU

:STEP3_CALL
CALL :STEP3
pause
GOTO MENU

:STEP4_CALL
CALL :STEP4
pause
GOTO MENU

:STEP5_CALL
CALL :STEP_MANUAL_DB
CALL :STEP5
pause
GOTO MENU

:STEP6_CALL
CALL :STEP6
pause
GOTO MENU

:STEP7_CALL
CALL :STEP7
pause
GOTO MENU


:STEP1
echo.
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
echo [SUCCESS] Limpieza finalizada. >> %LOGFILE%
echo. >> %LOGFILE%
GOTO :EOF


:STEP2
echo.
echo --- Instalando dependencias de PHP (Composer)...
echo --- Instalando dependencias de PHP (Composer)... >> %LOGFILE%
call composer install >> %LOGFILE% 2>&1
if %errorlevel% neq 0 (
    echo. & echo ERROR: 'composer install' fallo. Revisa %LOGFILE% para mas detalles. & echo [ERROR] 'composer install' fallo. >> %LOGFILE%
    GOTO :EOF
)
echo Dependencias de PHP instaladas.
echo [SUCCESS] Dependencias de PHP instaladas. >> %LOGFILE%
echo. >> %LOGFILE%
GOTO :EOF


:STEP3
echo.
echo --- Instalando dependencias de JS (NPM)...
echo --- Instalando dependencias de JS (NPM)... >> %LOGFILE%
call npm install >> %LOGFILE% 2>&1
if %errorlevel% neq 0 (
    echo. & echo ERROR: 'npm install' fallo. Revisa %LOGFILE% para mas detalles. & echo [ERROR] 'npm install' fallo. >> %LOGFILE%
    GOTO :EOF
)
echo Dependencias de JS instaladas.
echo [SUCCESS] Dependencias de JS instaladas. >> %LOGFILE%
echo. >> %LOGFILE%
GOTO :EOF


:STEP4
echo.
echo --- Configurando archivo de entorno .env y generando clave...
echo --- Configurando archivo de entorno .env y generando clave... >> %LOGFILE%
if not exist .env (
    copy .env.example .env >> %LOGFILE% 2>&1
    echo Archivo .env creado.
    echo [SUCCESS] Archivo .env creado. >> %LOGFILE%
) else (
    echo El archivo .env ya existe. Omitiendo creacion.
    echo [INFO] El archivo .env ya existe. Omitiendo creacion. >> %LOGFILE%
)
php artisan key:generate >> %LOGFILE% 2>&1
if %errorlevel% neq 0 (
    echo. & echo ERROR: 'php artisan key:generate' fallo. Revisa %LOGFILE%. & echo [ERROR] 'php artisan key:generate' fallo. >> %LOGFILE%
    GOTO :EOF
)
echo Clave de aplicacion generada.
echo [SUCCESS] Clave de aplicacion generada. >> %LOGFILE%
echo. >> %LOGFILE%
GOTO :EOF


:STEP_MANUAL_DB
echo.
echo =======================================================
echo      ACCION MANUAL REQUERIDA
echo =======================================================
echo.
echo Por favor, abre el archivo '.env' en un editor de texto y configura tus
echo credenciales de base de datos.
echo.
pause
GOTO :EOF


:STEP5
echo.
echo --- Ejecutando las migraciones de la base de datos...
echo --- Ejecutando las migraciones de la base de datos... >> %LOGFILE%
php artisan migrate >> %LOGFILE% 2>&1
if %errorlevel% neq 0 (
    echo. & echo ERROR: 'php artisan migrate' fallo. Revisa %LOGFILE%. & echo [ERROR] 'php artisan migrate' fallo. >> %LOGFILE%
    GOTO :EOF
)
echo Migraciones ejecutadas correctamente.
echo [SUCCESS] Migraciones ejecutadas correctamente. >> %LOGFILE%
echo. >> %LOGFILE%
GOTO :EOF


:STEP6
echo.
echo --- Creando el enlace simbolico de storage...
echo --- Creando el enlace simbolico de storage... >> %LOGFILE%
php artisan storage:link >> %LOGFILE% 2>&1
echo [INFO] Enlace simbolico de storage creado o ya existente. >> %LOGFILE%
echo. >> %LOGFILE%
GOTO :EOF


:STEP7
echo.
echo --- Compilando assets de frontend...
echo --- Compilando assets de frontend... >> %LOGFILE%
call npm run build >> %LOGFILE% 2>&1
if %errorlevel% neq 0 (
    echo. & echo ERROR: 'npm run build' fallo. Revisa %LOGFILE%. & echo [ERROR] 'npm run build' fallo. >> %LOGFILE%
    GOTO :EOF
)
echo Assets compilados.
echo [SUCCESS] Assets compilados. >> %LOGFILE%
echo. >> %LOGFILE%
GOTO :EOF


:SUCCESS_ALL
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
GOTO :EOF

:SALIR
endlocal
exit /b
