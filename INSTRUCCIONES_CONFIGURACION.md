# Instrucciones de Configuración y Puesta en Marcha

Esta guía detalla los pasos para configurar el proyecto, instalar dependencias y aplicar las configuraciones iniciales.

## 1. Requisitos Previos
- PHP 8.1+
- Composer
- Node.js & npm
- Git
- Una base de datos MySQL vacía.

## 2. Instalación
1.  Clona el repositorio.
2.  Copia el archivo `.env.example` a `.env`: `copy .env.example .env` (en Windows) o `cp .env.example .env` (en Linux/Mac).
3.  Configura tus credenciales de base de datos en el archivo `.env`.
4.  Instala las dependencias de PHP: `composer install`
5.  Instala las dependencias de JavaScript: `npm install`
6.  Genera la clave de la aplicación: `php artisan key:generate`

## 3. Configuración de la Base de Datos
1.  Publica los archivos de configuración de Spatie/permission:
    ```bash
    php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
    ```
2.  Ejecuta las migraciones y los seeders. Esto creará todas las tablas y los datos iniciales (roles, permisos, configuraciones por defecto, y usuarios de prueba).
    ```bash
    php artisan migrate:fresh --seed
    ```
3.  **Enlaza la carpeta de almacenamiento (Paso Importante para las Imágenes).** Para que las fotos de los miembros (y el logo) sean visibles, necesitas crear un "acceso directo" desde tu carpeta `public` a tu carpeta `storage`.
    ```bash
    php artisan storage:link
    ```
    **Nota para usuarios de Windows:** A veces, este comando falla si no se ejecuta con los permisos correctos. Si las imágenes no se ven después de ejecutarlo, intenta lo siguiente:
    1. Cierra tu terminal actual.
    2. Busca tu programa de terminal (CMD, PowerShell, etc.), haz clic derecho sobre él y selecciona "Ejecutar como administrador".
    3. Navega de nuevo a la carpeta de tu proyecto.
    4. Ejecuta `php artisan storage:link` otra vez.

## 4. Compilación de Assets y Ejecución
1.  Compila los archivos de frontend (CSS y JS).
    ```bash
    npm run build
    ```
2.  Para un desarrollo más fluido, es recomendable tener dos terminales abiertas:
    -   En la primera: `npm run dev` (vigila y compila los cambios de frontend automáticamente).
    -   En la segunda: `php artisan serve` (inicia el servidor de desarrollo de Laravel).

## 5. Acceso a la Aplicación
-   **URL:** http://127.0.0.1:8000 (o la que indique `php artisan serve`).
-   **Usuario Administrador:** `admin@gym.com`
-   **Contraseña:** `password`

Con estos pasos, la aplicación debería estar completamente funcional.
