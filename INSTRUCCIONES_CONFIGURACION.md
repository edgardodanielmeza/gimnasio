# Instrucciones de Configuración y Puesta en Marcha

Esta guía detalla los pasos para configurar el proyecto, instalar dependencias y aplicar las configuraciones iniciales. Ejecuta los comandos en una terminal en la raíz del proyecto.

## 1. Instalar Dependencias

### Backend (PHP - Composer)
```bash
# Instalar Spatie Laravel Permission para manejo de roles y permisos
composer require spatie/laravel-permission

# Publicar el archivo de configuración de Spatie
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

### Frontend (Node - npm)
```bash
# Instalar DaisyUI para componentes de Tailwind CSS
npm install -D daisyui@latest
```

## 2. Compilar Estilos
Después de instalar las dependencias de frontend, compila los assets:
```bash
npm run build
```

## 3. Configurar la Base de Datos
Asegúrate de que tu archivo `.env` tenga las credenciales correctas para tu base de datos MySQL.

**Ejemplo de configuración en `.env`:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gym_management_system
DB_USERNAME=root
DB_PASSWORD=
```

Una vez configurado, ejecuta las migraciones para crear la estructura de la base de datos.

```bash
# Ejecuta todas las migraciones (iniciales y las nuevas del sistema)
php artisan migrate
```
**Nota:** Se han añadido las nuevas migraciones para el sistema de gimnasio. Ejecuta el comando anterior para crear todas las tablas.

## 4. Ejecutar Seeders (Datos Iniciales)
Después de ejecutar las migraciones, puebla la base de datos con los roles, permisos y usuarios iniciales.

```bash
php artisan db:seed
```
Esto creará los roles 'Administrador' y 'Recepcionista', y dos usuarios de prueba:
- **Usuario:** `admin@gym.com` | **Contraseña:** `password`
- **Usuario:** `recepcion@gym.com` | **Contraseña:** `password`

## 5. Dependencias Frontend Adicionales (CDN)
Para las notificaciones de confirmación (por ejemplo, al eliminar un usuario), el CRUD de Usuarios utiliza la librería `SweetAlert2`. Se carga directamente desde una CDN en la vista, por lo que no requiere instalación manual vía `npm`.

## 6. Enlazar el Almacenamiento
Para que las fotos de los miembros sean visibles públicamente, ejecuta este comando:
```bash
php artisan storage:link
```

## 7. Actualizar Datos de Prueba (Seeders)
Cada vez que se añaden nuevos roles o permisos, es bueno re-ejecutar los seeders. El siguiente comando borrará tu base de datos y la volverá a crear con los nuevos permisos. **¡Cuidado, esto borra todos los datos!**
```bash
php artisan migrate:fresh --seed
```

---
*Este archivo se actualizará a medida que se agreguen nuevas instrucciones.*
