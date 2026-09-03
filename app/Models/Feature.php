<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
#[Fillable('package_id','description','description_ar')]
class Feature extends Model
{
    use SoftDeletes;
    public function package(){
        return $this->belongsTo(Package::class);
    }
}