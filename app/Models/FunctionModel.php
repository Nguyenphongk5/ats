<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunctionModel extends Model
{
    //
     use HasFactory;

    protected $table = 'function_models';

    protected $fillable = ['name', 'description', 'status'];
    public function jobs()
{
    return $this->hasMany(FunctionJob::class, 'function_id');
}

}
