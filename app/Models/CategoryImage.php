<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
#[Fillable(['category_id','image'])]
class CategoryImage extends Model
{
    use SoftDeletes;
    public function category(){
     return $this->belongsTo(Category::class);
    }
}