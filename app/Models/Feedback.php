<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
#[Fillable([
    'name',
    'name_ar',
    'feedback',
    'feedback_ar',
])]
class Feedback extends Model
{
    protected $table = 'feedbacks';
}
