<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'membership_id',
        'amount',
        'payment_date',
        'payment_method',
        'notes',
    ];

    /**
     * Get the membership that the payment belongs to.
     */
    public function membership(): BelongsTo
    {
        return $this->belongsTo(Membership::class);
    }
}
