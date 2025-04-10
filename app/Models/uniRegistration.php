<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class uniRegistration extends Model
{
    protected $fillable = [
        'uni_name',
        'uni_type',
        'postal_code',
        'established_year',
        'district',
        'area',
        'website_url',
        'email_address',
        'phone_number',
        'accreditation_status',
    ];
}
