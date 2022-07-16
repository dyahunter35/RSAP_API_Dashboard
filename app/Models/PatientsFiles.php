<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PatientsFiles extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'patients_files';

    protected $fillable = [
        'patient_id',
        'name',
        'check_date',
        'size',
        'type',
        'extention',
        'url'
    ];

    protected $appends = [
        'fileUrl',
        'readableSize'
    ];
    protected $hidden = [
        'size'
    ];


    public function scopePFile($query, $id)
    {
        return $query->where('patient_id', $id)->get()->groupBy('type'); //GROUP
    }


    public function getActivitylogOptions(): LogOptions
    {
        /*
        activity()
   ->causedBy($userModel)
   ->performedOn($someContentModel)
   ->tap(function(Activity $activity) {
      $activity->my_custom_field = 'my special value';
   })
   ->log('edited');
        */
        return LogOptions::defaults()
            ->logOnly(['name', 'text']);
        // Chain fluent methods for configuration options
    }

    public function getFileUrlAttribute()
    {
        return Storage::url($this->url);
    }

    public function getReadableSizeAttribute()
    {
        $byte = $this->size;
        $size = array('B', 'KB', 'MB', 'GB');
        $factor = floor((strlen($byte) - 1) / 3);

        return sprintf('%.2f', $byte / pow(1024, $factor)) . ' ' . $size[$factor];
    }

    public function permalink()
    {
        return route('pfile.show', $this->name);
    }

    protected static function booted()
    {
        static::deleted(function ($patients_files) {
            Storage::delete($patients_files->url);
        });
    }
}
