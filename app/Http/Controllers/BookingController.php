<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Category;
use App\Models\Package;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $category = Category::findOrFail($request->input('category_id'));
        $template = $category->bookingTemplate();

        $fields = $request->validate(array_merge([
            'category_id' => ['required', 'exists:categories,id'],
            'package_id' => ['required', 'exists:packages,id'],
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'date' => ['required', 'date', 'after_or_equal:today'],
            'time' => ['required', 'date_format:g:i A'],
            'share_on_social' => ['nullable', 'boolean'],
            'themes' => ['nullable', 'array'],
            'themes.*' => ['exists:themes,id'],
        ], $this->detailsRulesFor($template)));

        $package = Package::where('category_id', $category->id)->findOrFail($fields['package_id']);

        if (count($fields['themes'] ?? []) > $package->theme_limit) {
            return back()
                ->withErrors(['themes' => $package->theme_limit < 1
                    ? 'This package does not include theme selection.'
                    : "This package lets you choose up to {$package->theme_limit} theme(s)."])
                ->withInput();
        }

        // The gender-reveal template submits this as a select's "0"/"1" string,
        // not a real checkbox — cast it so it's stored as a true JSON boolean.
        if (array_key_exists('dress_rental', $fields['details'] ?? [])) {
            $fields['details']['dress_rental'] = (bool) $fields['details']['dress_rental'];
        }

        if (! \Carbon\Carbon::parse($fields['date'])->isWeekday()) {
            return back()
                ->withErrors(['date' => 'The studio is open Monday to Friday — please pick a weekday.'])
                ->withInput();
        }

        if (\Carbon\Carbon::parse("{$fields['date']} {$fields['time']}")->isPast()) {
            return back()
                ->withErrors(['time' => 'That time has already passed. Please choose a different time.'])
                ->withInput();
        }

        if (Booking::overlapsExisting($fields['date'], $fields['time'], $package->duration_max_minutes)) {
            return back()
                ->withErrors(['time' => 'Sorry, that time slot was just taken. Please choose another time.'])
                ->withInput();
        }

        $booking = Booking::create([
            'category_id' => $category->id,
            'package_id' => $package->id,
            'full_name' => $fields['full_name'],
            'phone' => $fields['phone'],
            'date' => $fields['date'],
            'start_time' => \Carbon\Carbon::parse($fields['time'])->format('H:i:s'),
            'duration_minutes' => $package->duration_max_minutes,
            'share_on_social' => $request->boolean('share_on_social'),
            'details' => $fields['details'] ?? [],
        ]);

        $booking->themes()->sync($fields['themes'] ?? []);

        return redirect()
            ->route('contact')
            ->with('success', "Thank you! Your booking request has been sent — we'll confirm with you over WhatsApp shortly.");
    }

    /**
     * The studio's standard 30-minute slots for a given date, each flagged
     * available/unavailable for the given package's duration — closed days,
     * already-passed times (for today), and time-overlaps with existing
     * pending/confirmed bookings are all marked unavailable.
     */
    public function availability(Request $request)
    {
        $request->validate([
            'package_id' => ['required', 'exists:packages,id'],
            'date' => ['required', 'date'],
        ]);

        $package = Package::findOrFail($request->query('package_id'));
        $date = $request->query('date');
        $isWeekday = \Carbon\Carbon::parse($date)->isWeekday();

        $slots = [];
        $cursor = \Carbon\Carbon::parse($date)->setTime(10, 0);
        $close = \Carbon\Carbon::parse($date)->setTime(16, 0);

        while ($cursor->lt($close)) {
            $label = $cursor->format('g:i A');

            $available = $isWeekday
                && $cursor->isFuture()
                && ! Booking::overlapsExisting($date, $label, $package->duration_max_minutes);

            $slots[] = ['time' => $label, 'available' => $available];
            $cursor->addMinutes(30);
        }

        return response()->json($slots);
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $fields = $request->validate([
            'status' => ['required', 'in:pending,confirmed,declined,cancelled'],
        ]);

        $booking->update($fields);

        return redirect()->route('admin.bookings.page')->with('success', 'Booking status updated.');
    }

    /**
     * Move a confirmed booking to a new date/time. Uses the same overlap and
     * weekday/past-time rules as a new booking, excluding the booking itself
     * from the conflict check so it doesn't collide with its own old slot.
     */
    public function reschedule(Request $request, Booking $booking)
    {
        $fields = $request->validate([
            'date' => ['required', 'date', 'after_or_equal:today'],
            'time' => ['required', 'date_format:H:i'],
        ]);

        if (! \Carbon\Carbon::parse($fields['date'])->isWeekday()) {
            return back()->withErrors(['reschedule' => 'The studio is open Monday to Friday — please pick a weekday.']);
        }

        if (\Carbon\Carbon::parse("{$fields['date']} {$fields['time']}")->isPast()) {
            return back()->withErrors(['reschedule' => 'That time has already passed. Please choose a different time.']);
        }

        if (Booking::overlapsExisting($fields['date'], $fields['time'], $booking->duration_minutes, $booking->id)) {
            return back()->withErrors(['reschedule' => 'That time overlaps another booking. Please choose a different time.']);
        }

        $booking->update([
            'date' => $fields['date'],
            'start_time' => $fields['time'],
        ]);

        return redirect()->route('admin.bookings.page')->with('success', 'Booking rescheduled successfully.');
    }

    /**
     * The category-specific validation rules, keyed by Category::bookingTemplate().
     * Each `details.*` field lands in the booking's `details` JSON column.
     */
    protected function detailsRulesFor(string $template): array
    {
        return match ($template) {
            'newborn' => [
                'details' => ['required', 'array'],
                'details.baby_name' => ['required', 'string', 'max:255'],
                'details.baby_age' => ['required', 'string', 'max:100'],
                'details.dress_choice' => ['nullable', 'string', 'max:1000'],
            ],
            'baby' => [
                'details' => ['required', 'array'],
                'details.child_name' => ['required', 'string', 'max:255'],
                'details.child_age' => ['required', 'string', 'max:100'],
                'details.dress_choice' => ['nullable', 'string', 'max:1000'],
            ],
            'birthday' => [
                'details' => ['required', 'array'],
                'details.child_name' => ['required', 'string', 'max:255'],
                'details.turning_age' => ['required', 'string', 'max:50'],
                'details.cake_choice' => ['nullable', 'in:none,classic,fun'],
                'details.family_shots_count' => ['nullable', 'integer', 'min:0'],
            ],
            'family' => [
                'details' => ['required', 'array'],
                'details.family_count' => ['required', 'integer', 'min:1'],
                'details.children_ages' => ['nullable', 'string', 'max:255'],
                'details.outfit_colors' => ['nullable', 'string', 'max:255'],
            ],
            'gender_reveal' => [
                'details' => ['required', 'array'],
                'details.reveal_color' => ['nullable', 'in:pink,blue,surprise'],
                'details.guest_count' => ['nullable', 'integer', 'min:0'],
                'details.dress_rental' => ['nullable', 'boolean'],
            ],
            default => [
                'details' => ['nullable', 'array'],
            ],
        };
    }
}
