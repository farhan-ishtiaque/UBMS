<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users'; // Explicitly set table name

    protected $fillable = [
        'FirstName',
        'LastName',
        'PhoneNumber',
        'email',
        'password',
        'type',
        'uni_id'
    ];

    protected $hidden = [
        'password',
        'remember_token', // Add this if using remember token functionality
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationship to University (for university admins)
    public function university()
    {
        return $this->belongsTo(University::class);
    }

    // Helper methods for role checking
    public function isUmsbPersonnel(): bool
    {
        return $this->type === 'umsb_personnel';
    }

    public function isUniversityAdmin(): bool
    {
        return $this->type === 'university_admin';
    }

    // Full name accessor
    public function getFullNameAttribute(): string
    {
        return "{$this->FirstName} {$this->LastName}";
    }
}