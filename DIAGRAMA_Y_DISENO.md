# Diagrama de Clases y Diseño Preliminar

Este documento describe la arquitectura de la base de datos a través de un diagrama de clases y una descripción detallada de los modelos Eloquent.

## 1. Diagrama de Clases (Mermaid)

```mermaid
classDiagram
    class User {
        +int id
        +string name
        +string email
        +int sucursal_id
        +hasRole()
        +belongsTo(Sucursal)
    }

    class Sucursal {
        +int id
        +string nombre
        +string direccion
        +hasMany(User)
        +hasMany(Miembro)
    }

    class Miembro {
        +int id
        +string documento_identidad
        +string nombre
        +string apellido
        +string email
        +int sucursal_registro_id
        +hasMany(Membresia)
        +hasMany(Asistencia)
        +belongsTo(Sucursal)
    }

    class TipoMembresia {
        +int id
        +string nombre
        +float precio
        +int duracion_dias
    }

    class Membresia {
        +int id
        +int miembro_id
        +int tipo_membresia_id
        +date fecha_inicio
        +date fecha_fin
        +string estado
        +belongsTo(Miembro)
        +belongsTo(TipoMembresia)
        +hasMany(Pago)
    }

    class Pago {
        +int id
        +int membresia_id
        +int user_id_receptor
        +float monto
        +string metodo_pago
        +belongsTo(Membresia)
        +belongsTo(User)
    }

    class Asistencia {
        +int id
        +int miembro_id
        +int sucursal_id
        +datetime fecha_hora_ingreso
        +datetime fecha_hora_salida
        +belongsTo(Miembro)
        +belongsTo(Sucursal)
    }

    class Setting {
        +int id
        +string key
        +string value
    }

    User "1" -- "1" Sucursal : "pertenece a"
    Sucursal "1" -- "0..*" User
    Sucursal "1" -- "0..*" Miembro
    Miembro "1" -- "1..*" Membresia
    Miembro "1" -- "0..*" Asistencia
    TipoMembresia "1" -- "0..*" Membresia
    Membresia "1" -- "0..*" Pago
    User "1" -- "0..*" Pago : "registra"
```

## 2. Descripción de Modelos Eloquent

### User
- Representa a los empleados del gimnasio (Administrador, Recepcionista).
- Utiliza `spatie/laravel-permission` para roles.

### Sucursal
- Representa una de las ubicaciones físicas del gimnasio.

### Miembro
- Representa a los clientes del gimnasio. El `documento_identidad` es su clave.

### TipoMembresia
- Define los planes que ofrece el gimnasio (ej. Mensual, Anual).

### Membresia
- La suscripción de un `Miembro` a un `TipoMembresia`.

### Pago
- Registra cada pago realizado para una `Membresia`.

### Asistencia
- Registra cada ingreso y salida de un `Miembro`.

### Setting
- Almacena la configuración global de la aplicación en formato clave-valor (ej. tema, logo, nombre de la app).
