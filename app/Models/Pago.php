<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'membresia_id', 'user_id_receptor', 'monto',
        'metodo_pago', 'fecha_pago', 'notas'
    ];

    public function membresia()
    {
        return $this->belongsTo(Membresia::class);
    }

    public function receptor()
    {
        return $this->belongsTo(User::class, 'user_id_receptor');
    }
}
