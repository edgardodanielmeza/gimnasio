<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Miembro extends Model
{
    use HasFactory;

    protected $fillable = [
        'documento_identidad', 'nombre', 'apellido', 'telefono',
        'email', 'fecha_nacimiento', 'foto_path', 'sucursal_registro_id'
    ];

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_registro_id');
    }

    public function membresias()
    {
        return $this->hasMany(Membresia::class);
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
}
