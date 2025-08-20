<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = 'sucursales';

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
    ];

    public function registrosAcceso()
    {
        return $this->hasMany(RegistroAcceso::class, 'sucursal_id');
    }
}
