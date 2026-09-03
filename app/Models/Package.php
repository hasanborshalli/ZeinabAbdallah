<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
#[Fillable('name','name_ar','price','duration_min_minutes','duration_max_minutes','category_id','is_active','theme_limit')]
class Package extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'theme_limit' => 'integer',
        ];
    }

    public function features(){
        return $this->hasMany(Feature::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }

    public function formattedPrice(): string
    {
        $price = (float) $this->price;

        return '$' . (floor($price) == $price ? number_format($price, 0) : number_format($price, 2));
    }

    public function durationLabel(): string
    {
        $isArabic = app()->getLocale() === 'ar';

        $format = function (int $minutes) use ($isArabic) {
            if ($minutes % 60 === 0) {
                return $minutes / 60;
            }

            return rtrim(rtrim(number_format($minutes / 60, 1), '0'), '.');
        };

        $usesHours = $this->duration_min_minutes >= 60;
        $min = $usesHours ? $format($this->duration_min_minutes) : $this->duration_min_minutes;
        $max = $usesHours ? $format($this->duration_max_minutes) : $this->duration_max_minutes;

        $unit = $usesHours
            ? ($isArabic ? 'ساعة' : ($max == 1 ? 'hour' : 'hours'))
            : ($isArabic ? 'دقيقة' : 'minutes');

        $value = $min == $max ? (string) $min : "{$min}–{$max}";

        return "{$value} {$unit}";
    }
}