<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityAdmin extends Model
{
    protected $primaryKey = 'admin_id';

    protected $fillable = ['uni_id', 'admin_name', 'designation', 'joining_date', 'leaving_date', 'status'];

    public function university()
    {
        return $this->belongsTo(University::class, 'uni_id');
    }
}
