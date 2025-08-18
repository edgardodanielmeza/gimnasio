<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'identity_document',
        'first_name',
        'last_name',
        'address',
        'phone',
        'email',
        'birth_date',
        'photo_path',
    ];

    /**
     * Get the memberships for the member.
     */
    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    /**
     * Get the access logs for the member.
     */
    public function accessLogs()
    {
        return $this->hasMany(AccessLog::class);
    }
}
