<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'miembro_id', 'sucursal_id', 'fecha_hora_ingreso', 'fecha_hora_salida'
    ];

    public function miembro()
    {
        return $this->belongsTo(Miembro::class);
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
}
