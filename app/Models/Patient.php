<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Patient extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name',
        'phone',
        'blood-type',
        'gender',
        'nat_num',
        'allergies',
        'birth_date'
    ];


    protected $hidden = [
        'file',
        'created_at',
        'updated_at',
        'birth_date',
    ];
    protected $appends = [
        'age', 'file','diseases'
    ];

    public function files()
    {
        $data = $this->hasMany(PatientsFiles::class);
        return $data;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'text']);
        // Chain fluent methods for configuration options
    }

    public function diseases()
    {
        $data = $this->hasMany(Disease::class);
        //dd($data);

        return $data;
    }

    public function getFileAttribute()
    {
        $data = PatientsFiles::pFile($this->id);
        return $data;
    }
    public function getDiseasesAttribute()
    {
        $data = Disease::PDisease($this->id);
        return $data;
    }

    public function getAgeAttribute()
    {
        $dateOfBirth = $this->birth_date;
        $today = date("Y-m-d");
        $diff = date_diff(date_create($dateOfBirth), date_create($today));
        return $diff->format('%y years %m month');
    }
}
