<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CvNote extends Model
{
    //
    protected $fillable = ['cv_id', 'note'];

    public function cv()
    {
        return $this->belongsTo(Cv::class);
    }
}
