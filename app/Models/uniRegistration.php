<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $fillable = [
        'uni_name',
        'uni_type',
        'portal_code',
        'established_year',
        'district',
        'area',
        'website_url',
        'email_address',
        'phone_number',
        'accreditation_status',
    ];
}
