<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $fillable = [
        'job_id',
        'user_id', // phải có nếu bạn truyền vào
        'full_name',
        'birth_year',
        'last_company',
        'last_position',
        'file_path',
    ];

    public function job()
    {
        return $this->belongsTo(\App\Models\Job::class);
    }
    public function notes()
{
    return $this->hasMany(CvNote::class);
}

}
