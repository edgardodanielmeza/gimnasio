# Guía de Instalación y Pruebas del Proyecto

Este documento contiene todos los pasos necesarios para instalar, configurar y ejecutar el proyecto del Sistema de Gestión de Gimnasio en tu entorno local utilizando WAMP en Windows.

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

## 2. Instalación del Proyecto

1.  **Abrir una Terminal**
    *   Puedes usar `Git Bash` (recomendado, viene con Git), `cmd` o `PowerShell`.

2.  **Clonar el Repositorio**
    *   Navega al directorio donde WAMP guarda los proyectos (normalmente `c:\wamp64\www`).
      ```sh
      cd c:\wamp64\www
      ```
    *   Clona el repositorio del proyecto (reemplaza `URL_DEL_REPOSITORIO` con la URL real de tu repositorio Git).
      ```sh
      git clone URL_DEL_REPOSITORIO gym-management-system
      ```
    *   Accede al directorio del proyecto.
      ```sh
      cd gym-management-system
      ```

3.  **Instalar Dependencias de PHP**
    *   Ejecuta Composer para instalar todas las librerías de backend.
      ```sh
      composer install
      ```

4.  **Instalar Dependencias de JavaScript**
    *   Ejecuta NPM para instalar las dependencias de frontend.
      ```sh
      npm install
      ```

## 3. Configuración del Entorno

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
    *   Abre el archivo `.env` con un editor de texto.
    *   Modifica las siguientes variables para que coincidan con la configuración de tu base de datos MySQL en WAMP. El usuario por defecto suele ser `root` sin contraseña.
      ```dotenv
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=gym_management # Puedes usar este nombre o elegir otro
      DB_USERNAME=root
      DB_PASSWORD=
      ```

4.  **Crear la Base de Datos en MySQL**
    *   Asegúrate de que tu servidor WAMP esté en línea.
    *   Abre `phpMyAdmin` (normalmente en `http://localhost/phpmyadmin`).
    *   Crea una nueva base de datos con el mismo nombre que pusiste en `DB_DATABASE` (ej. `gym_management`). Utiliza la codificación `utf8mb4_unicode_ci`.

5.  **Ejecutar las Migraciones**
    *   Este comando creará todas las tablas de la aplicación en tu base de datos.
      ```sh
      php artisan migrate
      ```

6.  **Compilar los Archivos de Frontend**
    *   Este comando compilará los archivos CSS y JS.
      ```sh
      npm run build
      ```

## 4. Ejecución y Pruebas

1.  **Iniciar el Servidor de Desarrollo**
    *   Ejecuta el siguiente comando para iniciar el servidor local de Laravel.
      ```sh
      php artisan serve
      ```

2.  **Acceder a la Aplicación**
    *   Abre tu navegador y visita la dirección `http://127.0.0.1:8000`.
    *   Deberías ver la página de bienvenida de Laravel.

3.  **Pruebas Funcionales**
    *   **Registro y Login**: Haz clic en "Register" en la esquina superior derecha. Crea una nueva cuenta y luego inicia sesión.
    *   **Dashboard**: Deberías ser redirigido al Dashboard de la aplicación.
    *   **Gestión de Sucursales**:
        *   Haz clic en el enlace "Sucursales" en el menú de navegación.
        *   **Crear**: Haz clic en el botón "Crear Sucursal", llena el formulario y guarda. Deberías ver un mensaje de éxito y la nueva sucursal en la tabla.
        *   **Buscar**: Escribe en el campo de búsqueda para filtrar las sucursales por nombre o dirección.
        *   **Editar**: Haz clic en el botón "Editar" de una sucursal, modifica los datos y actualiza. Los cambios deberían reflejarse en la tabla.
        *   **Eliminar**: Haz clic en el botón "Eliminar" y confirma la acción. La sucursal debería desaparecer de la tabla.

---
Si sigues todos estos pasos, tendrás una copia funcional del proyecto corriendo en tu máquina local.
