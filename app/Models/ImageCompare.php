<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ImageCompare extends Model
{
    use HasFactory;

    protected $table = "image_compares";

    protected $fillable = [
        'patient_id'
    ];
    protected static function booted()
    {
        static::deleted(function ($image_compare) {
            Storage::delete($image_compare->url);
        });
    }
}
