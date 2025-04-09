<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentScholarship extends Model
{
    protected $primaryKey = 'scholarship_id';

    protected $fillable = ['semester', 'year'];

    public function students()
    {
        return $this->belongsToMany(Students::class, 'stud_scholarship')
                    ->withPivot('application_date', 'disbursement_date', 'percentage', 'status');
    }
}
