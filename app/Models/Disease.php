<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory;

    protected $fillable = [
        'chronic'
    ];
    
    public function scopePDisease($query, $id)
    {
        return $query->where('patient_id', $id)->get()->groupBy('chronic'); //GROUP
    }
}
