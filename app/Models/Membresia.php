<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membresia extends Model
{
    use HasFactory;

    protected $fillable = [
        'miembro_id', 'tipo_membresia_id', 'fecha_inicio',
        'fecha_fin', 'estado'
    ];

    public function miembro()
    {
        return $this->belongsTo(Miembro::class);
    }

    public function tipoMembresia()
    {
        return $this->belongsTo(TipoMembresia::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}
