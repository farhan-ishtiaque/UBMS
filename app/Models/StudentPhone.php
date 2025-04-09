<?php
// StudentPhone.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPhone extends Model
{
    protected $fillable = ['student_id', 'phone_number'];

    public function student()
    {
        return $this->belongsTo(Students::class);
    }
}
