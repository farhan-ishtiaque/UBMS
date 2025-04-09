<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rankings extends Model
{
    protected $primaryKey = 'ranking_id';

    protected $fillable = [
        'uni_id', 'rank_value', 'ranking_criteria', 'published_date',
        'ranking_score', 'ranking_year'
    ];

    public function university()
    {
        return $this->belongsTo(University::class, 'uni_id');
    }
}
