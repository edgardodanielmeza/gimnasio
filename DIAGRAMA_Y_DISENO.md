# Diagrama de Clases y Diseño Preliminar

Este documento describe la arquitectura de la base de datos a través de un diagrama de clases y una descripción detallada de los modelos Eloquent.

## 1. Diagrama de Clases (Mermaid)

```mermaid
classDiagram
    class User {
        +int id
        +string name
        +string email
        +string password
        +string profile_photo_path
        +int sucursal_id
        +hasMany(Pago)
        +hasMany(Asistencia)
        +belongsTo(Sucursal)
        +hasRole()
    }

    class Sucursal {
        +int id
        +string nombre
        +string direccion
        +string telefono
        +hasMany(User)
        +hasMany(Miembro)
    }

    class Miembro {
        +int id
        +string documento_identidad
        +string nombre
        +string apellido
        +string telefono
        +string email
        +date fecha_nacimiento
        +string foto_path
        +int sucursal_registro_id
        +hasMany(Membresia)
        +hasMany(Asistencia)
        +belongsTo(Sucursal)
    }

    class TipoMembresia {
        +int id
        +string nombre (e.g., "Mensual", "Anual")
        +string descripcion
        +float precio
        +int duracion_dias
    }

    class Membresia {
        +int id
        +int miembro_id
        +int tipo_membresia_id
        +date fecha_inicio
        +date fecha_fin
        +string estado ('activa', 'vencida', 'suspendida')
        +belongsTo(Miembro)
        +belongsTo(TipoMembresia)
        +hasMany(Pago)
    }

    class Pago {
        +int id
        +int membresia_id
        +int user_id_receptor
        +float monto
        +string metodo_pago ('efectivo', 'tarjeta')
        +datetime fecha_pago
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

    User "1" -- "0..*" Pago : "registra"
    User "1" -- "1" Sucursal : "pertenece a"
    Sucursal "1" -- "0..*" User : "tiene"
    Sucursal "1" -- "0..*" Miembro : "registra en"
    Miembro "1" -- "1..*" Membresia : "tiene"
    Miembro "1" -- "0..*" Asistencia : "registra"
    TipoMembresia "1" -- "0..*" Membresia : "es de tipo"
    Membresia "1" -- "1..*" Pago : "se paga con"
```

## 2. Descripción de Modelos Eloquent

### User
- Representa a los empleados del gimnasio (Administrador, Recepcionista).
- Se relaciona con `Sucursal` para saber a qué sucursal pertenece el empleado.
- Utiliza `spatie/laravel-permission` para la gestión de roles.
- Registra los `Pagos` que recibe.

### Sucursal
- Representa una de las ubicaciones físicas del gimnasio.
- Contiene usuarios (empleados) y miembros registrados en esa sucursal.

### Miembro
- La tabla central, representa a los clientes del gimnasio.
- El `documento_identidad` es su identificador único para el acceso.
- Tiene un historial de `Membresias`.
- Se registra en una sucursal principal (`sucursal_registro_id`) pero puede tener `Asistencia` en cualquiera.

### TipoMembresia
- Define los planes que ofrece el gimnasio (ej. Mensual, Trimestral, Anual).
- Contiene el precio y la duración de cada tipo de membresía.

### Membresia
- Representa la suscripción de un `Miembro` a un `TipoMembresia`.
- Tiene una fecha de inicio, fin y un estado para controlar el acceso.

### Pago
- Registra cada pago realizado para una `Membresia`.
- Guarda quién (`User`) recibió el pago.

### Asistencia
- Registra cada ingreso y salida de un `Miembro` en una `Sucursal`.
- Permite el control de acceso y genera reportes de afluencia.
