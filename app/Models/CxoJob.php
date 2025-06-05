<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CxoJob extends Model
{
    //
     use HasFactory;

    protected $fillable = ['cxo_id', 'title', 'description', 'status'];

    public function cxo()
    {
        return $this->belongsTo(Cxo::class);
    }
}
