<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniFunding extends Model
{
    protected $primaryKey = 'funding_id';

    protected $fillable = [
        'uni_id', 'allocation_date', 'allocation_amount',
        'funding_type', 'funding_source', 'disbursement_date'
    ];

    public function university()
    {
        return $this->belongsTo(University::class, 'uni_id');
    }
}
