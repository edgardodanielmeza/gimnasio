# Guía de Instalación y Pruebas del Proyecto

Este documento contiene todos los pasos necesarios para instalar, configurar y ejecutar el proyecto del Sistema de Gestión de Gimnasio en tu entorno local.

## 1. Prerrequisitos

Asegúrate de tener el siguiente software instalado en tu sistema (Windows):

1.  **Git**: Para clonar el repositorio. Puedes descargarlo desde [git-scm.com](https://git-scm.com/).
2.  **WAMP Server**: Te proporcionará Apache, MySQL y PHP.
    *   Descárgalo desde [wampserver.com](https://www.wampserver.com/en/).
    *   Asegúrate de que la versión de **PHP sea 8.1 o superior**. Puedes cambiar la versión de PHP desde el menú de WAMP.
3.  **Composer**: El gestor de dependencias para PHP.
    *   Descárgalo e instálalo desde [getcomposer.org](https://getcomposer.org/download/).
4.  **Node.js y NPM**: Necesario para las dependencias de frontend.
    *   Descárgalo desde [nodejs.org](https://nodejs.org/).

## 2. Instalación (Método Recomendado para Windows)

Hemos creado un script que automatiza todo el proceso de instalación y configuración.

1.  **Descargar y Preparar el Proyecto**
    *   Descarga el código fuente del proyecto como un archivo ZIP desde GitHub.
    *   Descomprime el archivo ZIP en tu directorio de trabajo de WAMP (ej. `c:\wamp64\www`).
    *   Renombra la carpeta descomprimida a `gym-management-system` para que la ruta sea `c:\wamp64\www\gym-management-system`.
    *   Abre una terminal (`cmd`, `PowerShell` o `Git Bash`) y accede a ese directorio:
      ```sh
      cd c:\wamp64\www\gym-management-system
      ```

2.  **Ejecutar el Script de Instalación**
    *   Simplemente ejecuta el archivo `setup.bat` haciendo doble clic en él o desde la terminal:
      ```bat
      setup.bat
      ```
    *   El script te guiará a través de la instalación, limpiará instalaciones anteriores, instalará todas las dependencias y te pedirá en un punto que configures tu base de datos.
    *   Sigue las instrucciones que aparecen en pantalla.

3.  **Iniciar el Servidor**
    *   Una vez que el script termine, puedes iniciar el servidor de desarrollo con el comando que te sugerirá al final:
      ```sh
      php artisan serve
      ```

¡Y eso es todo! El método manual detallado a continuación ya no es necesario si usas el script.

---

<details>
<summary>Haga clic aquí para ver los pasos de Instalación Manual (Alternativa)</summary>

### A. Instalar Dependencias
1.  **Instalar Dependencias de PHP**
    *   Ejecuta Composer para instalar todas las librerías de backend.
      ```sh
      composer install
      ```

2.  **Instalar Dependencias de JavaScript**
    *   Ejecuta NPM para instalar las dependencias de frontend.
      ```sh
      npm install
      ```

### C. Configuración del Entorno
1.  **Crear el Archivo de Entorno (`.env`)**
    *   Copia el archivo de ejemplo.
      ```sh
      copy .env.example .env
      ```

2.  **Generar la Clave de la Aplicación**
    *   Este comando es crucial para la seguridad de Laravel.
      ```sh
      php artisan key:generate
      ```

3.  **Configurar la Base de Datos en `.env`**
    *   Abre el archivo `.env` con un editor de texto y configúralo con tus datos de MySQL.

4.  **Crear la Base de Datos en MySQL**
    *   Abre `phpMyAdmin` y crea una nueva base de datos con el mismo nombre que pusiste en el archivo `.env`.

5.  **Ejecutar las Migraciones**
    *   Este comando creará todas las tablas de la aplicación.
      ```sh
      php artisan migrate
      ```

6.  **Compilar los Archivos de Frontend**
    *   Este comando compilará los archivos CSS y JS.
      ```sh
      npm run build
      ```
</details>

## 3. Ejecución y Pruebas

1.  **Iniciar el Servidor de Desarrollo**
    *   Ejecuta el siguiente comando para iniciar el servidor local de Laravel.
      ```sh
      php artisan serve
      ```

2.  **Acceder a la Aplicación**
    *   Abre tu navegador y visita la dirección `http://127.0.0.1:8000`.

3.  **Pruebas Funcionales**
    *   **Registro y Login**: Crea una nueva cuenta y luego inicia sesión.
    *   **Dashboard**: Deberías ser redirigido al Dashboard.
    *   **Gestión de Sucursales**:
        *   Accede a la sección "Sucursales".
        *   Prueba crear, editar, buscar y eliminar sucursales.

---
Si sigues estos pasos, tendrás una copia funcional del proyecto corriendo en tu máquina local.
