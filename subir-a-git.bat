@echo off
setlocal

echo =======================================================
echo      Asistente para Subir Proyecto a Git
echo =======================================================
echo.
echo Este script anadira todos los archivos del proyecto,
echo creara un commit inicial y lo subira a tu repositorio
echo de GitHub.
echo.
echo Ejecuta este script DESDE DENTRO de la carpeta del
echo proyecto que has creado (gym-management-system).
echo.
pause
echo.

set /p REPO_URL="Por favor, pega la URL de tu repositorio de GitHub y presiona Enter: "

if "%REPO_URL%"=="" (
    echo.
    echo ERROR: La URL no puede estar vacia.
    pause
    exit /b 1
)

echo.
echo --- Anadiendo todos los archivos a Git...
git add .
echo.

echo --- Creando el commit inicial...
git commit -m "Initial project setup via script"
echo.

echo --- Conectando con el repositorio remoto...
git remote add origin %REPO_URL%
if %errorlevel% neq 0 (
    echo. & echo ADVERTENCIA: No se pudo anadir el remoto. Puede que ya exista. Intentando continuar... & echo.
)

echo.
echo --- Subiendo el proyecto a la rama 'main'...
git push -u origin main
if %errorlevel% neq 0 (
    echo.
    echo ERROR: 'git push' fallo.
    echo.
    echo Posibles soluciones:
    echo 1. Asegurate de que la URL del repositorio es correcta.
    echo 2. Asegurate de que tienes permisos para subir al repositorio.
    echo 3. Si tu rama por defecto no es 'main', puedes probar a ejecutar manualmente: git push -u origin master
    pause
    exit /b %errorlevel%
)

echo.
echo =======================================================
echo      ¡Proyecto subido a GitHub con exito!
echo =======================================================
echo.
echo Ahora yo podre descargar el proyecto base para anadir
echo las funcionalidades del gimnasio.
echo.
pause
endlocal
