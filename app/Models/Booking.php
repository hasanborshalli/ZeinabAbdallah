<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'category_id',
    'package_id',
    'full_name',
    'phone',
    'date',
    'start_time',
    'duration_minutes',
    'share_on_social',
    'status',
    'details',
])]
class Booking extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'share_on_social' => 'boolean',
            'details' => 'array',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function themes()
    {
        return $this->belongsToMany(Theme::class);
    }

    public function endTime(): \Carbon\Carbon
    {
        return \Carbon\Carbon::parse($this->date->format('Y-m-d') . ' ' . $this->start_time)
            ->addMinutes($this->duration_minutes);
    }

    /**
     * Whether this booking's time window overlaps another [start, start+duration) window
     * on the same day, for a given date/time/duration combination. Pass $exceptId when
     * checking a reschedule, so the booking being moved doesn't conflict with itself.
     */
    public static function overlapsExisting(string $date, string $startTime, int $durationMinutes, ?int $exceptId = null): bool
    {
        $newStart = \Carbon\Carbon::parse("{$date} {$startTime}");
        $newEnd = $newStart->copy()->addMinutes($durationMinutes);

        return static::whereDate('date', $date)
            ->whereIn('status', ['pending', 'confirmed'])
            ->when($exceptId, fn ($q) => $q->where('id', '!=', $exceptId))
            ->get()
            ->contains(function (self $booking) use ($newStart, $newEnd) {
                $existingStart = \Carbon\Carbon::parse($booking->date->format('Y-m-d') . ' ' . $booking->start_time);
                $existingEnd = $existingStart->copy()->addMinutes($booking->duration_minutes);

                return $newStart->lt($existingEnd) && $existingStart->lt($newEnd);
            });
    }
}
