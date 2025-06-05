<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FunctionJob extends Model
{
    //
    public function functionModel()
{
    return $this->belongsTo(FunctionModel::class, 'function_model_id');
}

}
