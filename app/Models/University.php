<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $primaryKey = 'uni_id';
    protected $table = 'universities';

    protected $fillable = [
        'uni_name', 'email_address', 'phone_number', 'website_url', 'district',
        'postal_code', 'area', 'location', 'accreditation_status', 'established_year', 'uni_type'
    ];

    public function admin()
    {
        return $this->hasOne(UniversityAdmin::class, 'uni_id');
    }

    public function departments()
    {
        return $this->hasMany(Departments::class, 'uni_id');
    }

    public function students()
    {
        return $this->hasMany(Students::class, 'uni_id');
    }

    public function faculties()
    {
        return $this->hasMany(Faculties::class, 'uni_id');
    }

    public function jobPostings()
    {
        return $this->hasMany(JobPostings::class, 'uni_id');
    }

    public function fundings()
    {
        return $this->hasMany(UniFunding::class, 'uni_id');
    }

    public function rankings()
    {
        return $this->hasMany(Rankings::class, 'uni_id');
    }



    // Add this scope method
    public function scopeAccredited($query)
    {
        return $query->where('accreditation_status', 'Accredited');
    }
}
