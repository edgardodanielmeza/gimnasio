<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'duration_days',
        'price',
    ];

    /**
     * Get the memberships for the membership type.
     */
    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }
}
