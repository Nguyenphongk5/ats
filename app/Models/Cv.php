<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $fillable = [
        'job_id',
    'user_id',
    'full_name',
    'birth_year',
    'last_company',
    'last_position',
    'file_path',
    'qualified',
    'interview1',
    'interview2',
    'offer',
    'hand',
    'qualify_date',
    'interview1_date',
    'interview2_date',
    'offer_date',
    'hand_date',
    ];

    public function job()
    {
        return $this->belongsTo(\App\Models\Job::class);
    }
    public function notes()
{
    return $this->hasMany(CvNote::class);
}

    protected $casts = [
    'qualify_date' => 'datetime',
    'interview1_date' => 'datetime',
    'interview2_date' => 'datetime',
    'offer_date' => 'datetime',
    'hand_date' => 'datetime',
];
}
