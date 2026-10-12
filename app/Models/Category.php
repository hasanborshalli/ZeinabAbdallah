<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
#[Fillable([
    'title',
    'title_ar',
    'slug',
    'description',
    'description_ar',
    'highlight',
    'highlight_ar',
    'main_image',
    'small_description',
    'small_description_ar',
    'gift'
])]
class Category extends Model
{
    use SoftDeletes;
    public function packages(){
        return $this->hasMany(Package::class);
    }

    public function notes(){
        return $this->hasMany(Note::class);
    }
    public function images(){
        return $this->hasMany(CategoryImage::class);
    }

    public function themes(){
        return $this->hasMany(Theme::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Which booking-form question set this category uses. Matched by title
     * keyword rather than ID, since the actual set of categories is fixed by
     * the business (newborn/baby/birthday/family/gender reveal) regardless of
     * what order they were created in or how their titles get edited around
     * that keyword. Anything unrecognized falls back to the generic template.
     * Single source of truth for both the contact form and BookingController.
     */
    public function bookingTemplate(): string
    {
        $title = strtolower($this->title);

        return match (true) {
            str_contains($title, 'newborn') => 'newborn',
            str_contains($title, 'baby'), str_contains($title, 'toddler') => 'baby',
            str_contains($title, 'birthday') => 'birthday',
            str_contains($title, 'family') => 'family',
            str_contains($title, 'gender') => 'gender_reveal',
            default => 'generic',
        };
    }
}