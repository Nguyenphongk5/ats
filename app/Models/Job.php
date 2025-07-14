<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
           'title',
    'description',
    'start_date',
     'end_date',
    'company_id',
    'status',
    'type',
    'vacancy', // thêm trường vacancy

        // thêm nếu bạn có các trường khác
    ];

    // Thêm cast để Laravel tự động chuyển string thành Carbon
   protected $casts = [
    'start_date' => 'date',
    'end_date' => 'date',
];


    // Quan hệ với công ty
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Quan hệ với CV (nếu có)
    public function cvs()
    {
        return $this->hasMany(Cv::class);
    }
}
