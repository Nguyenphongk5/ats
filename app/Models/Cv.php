<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $fillable = [
        'user_id',
        'job_id',
        'file_path',
    ];

    public function job()
    {
        return $this->belongsTo(\App\Models\Job::class);
    }
}
