<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
#[Fillable(['name','category_id','image','name_ar'])]
class Theme extends Model
{
    public function category(){
      return $this->belongsTo(Category::class);
    }
}