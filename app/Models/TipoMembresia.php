<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMembresia extends Model
{
    use HasFactory;

    protected $table = 'tipos_membresia';

    protected $fillable = [
        'nombre',
        'duracion_dias',
        'precio',
    ];

    public function membresias()
    {
        return $this->hasMany(Membresia::class);
    }
}
