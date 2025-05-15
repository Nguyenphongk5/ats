<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
        use HasFactory;

    // Cho phép mass-assignment các trường này
    protected $fillable = [
        'name',
        'description',
        'open_date',
        'close_date',
    ];
    public function cvs()
    {

        return $this->hasMany(\App\Models\Cv::class);
    }
}
