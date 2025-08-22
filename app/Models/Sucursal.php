<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'direccion', 'telefono'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function miembros()
    {
        return $this->hasMany(Miembro::class, 'sucursal_registro_id');
    }
}
