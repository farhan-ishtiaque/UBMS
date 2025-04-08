<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $fillable = [
        'uni_name',
        'district',
        'area',
        'email_address',
        'phone_number',
        'accreditation_status',
        'uni_type',
        'established_year',
        'postal_code',
        'website_url'
    ];

    public function scopeAccredited($query)
    {
        return $query->where('accreditation_status', 'accredited');
    }
}

