<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $table = 'universities'; // Specify the table name
    protected $fillable = [
        'uni_name',
        'uni_type',
        'established_year',
        'portal_code',
        'accreditation_status',
        'district',
        'area',
        'website_url',
        'email_address',
        'phone_number',
    ]; // Specify fillable fields
}