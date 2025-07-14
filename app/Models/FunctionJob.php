<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FunctionJob extends Model
{
    //
     protected $fillable = ['function_id', 'title', 'description', 'status'];
 public function functionModel()
{
    return $this->belongsTo(FunctionModel::class, 'function_id'); // ✅ sửa lại để khớp
}


}
