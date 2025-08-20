<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Miembro extends Model
{
    use HasFactory;

    protected $table = 'miembros';

    protected $fillable = [
        'documento_identidad',
        'nombres',
        'apellidos',
        'direccion',
        'telefono',
        'email',
        'fecha_nacimiento',
        'ruta_foto',
    ];

    public function membresias()
    {
        return $this->hasMany(Membresia::class);
    }

    public function registrosAcceso()
    {
        return $this->hasMany(RegistroAcceso::class);
    }
}
