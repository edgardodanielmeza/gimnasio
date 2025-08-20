<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Membresia extends Model
{
    use HasFactory;

    protected $table = 'membresias';

    protected $fillable = [
        'miembro_id',
        'tipo_membresia_id',
        'fecha_inicio',
        'fecha_fin',
        'estado',
    ];

    public function miembro(): BelongsTo
    {
        return $this->belongsTo(Miembro::class, 'miembro_id');
    }

    public function tipoMembresia(): BelongsTo
    {
        return $this->belongsTo(TipoMembresia::class, 'tipo_membresia_id');
    }

    public function pagos(): HasMany
    {
        return $this->hasMany(Pago::class, 'membresia_id');
    }
}
