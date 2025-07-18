<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cxo extends Model
{
     protected $table = 'cxos';  // nếu tên bảng khác mặc định (cxos)

  protected $fillable = ['position', 'description', 'status'];
   public function jobs()
{
    return $this->hasMany(CxoJob::class);
}

}
