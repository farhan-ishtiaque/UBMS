<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UniversityAdmin extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'admin_id';

    protected $fillable = [
        'uni_id',
        'first_name',
        'last_name',
        'designation',
        'email_address',
        'phone_number',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relationship: A University Admin belongs to a University
    public function university()
    {
        return $this->belongsTo(University::class, 'uni_id', 'uni_id');
    }
}