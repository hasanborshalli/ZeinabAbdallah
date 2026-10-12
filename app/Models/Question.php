<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
#[Fillable([
    'category_id',
    'question',
    'question_ar',
    'answer',
    'answer_ar',
])]
class Question extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}