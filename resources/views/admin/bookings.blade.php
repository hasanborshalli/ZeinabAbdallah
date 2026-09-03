@php
    $statusBadge = fn (string $status) => match ($status) {
        'confirmed' => 'text-bg-success',
        'declined' => 'text-bg-danger',
        'cancelled' => 'text-bg-secondary',
        default => 'text-bg-warning',
    };
@endphp

<x-alayout title="Bookings">

    <main class="col-md-9 col-lg-10 admin-main">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-4">
            <div>
                <h1 class="admin-page-title h4">Bookings</h1>
                <p class="text-muted mb-0">Review booking requests and confirm them with customers over WhatsApp.</p>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="mb-4 d-flex flex-wrap gap-2">
            <a href="{{ route('admin.bookings.page') }}" class="btn btn-sm {{ !$activeStatus ? 'btn-admin-gold' : 'btn-outline-secondary' }}">
                All ({{ $counts['all'] }})
            </a>
            <a href="{{ route('admin.bookings.page', ['status' => 'pending']) }}" class="btn btn-sm {{ $activeStatus === 'pending' ? 'btn-admin-gold' : 'btn-outline-secondary' }}">
                Pending ({{ $counts['pending'] }})
            </a>
            <a href="{{ route('admin.bookings.page', ['status' => 'confirmed']) }}" class="btn btn-sm {{ $activeStatus === 'confirmed' ? 'btn-admin-gold' : 'btn-outline-secondary' }}">
                Confirmed ({{ $counts['confirmed'] }})
            </a>
            <a href="{{ route('admin.bookings.page', ['status' => 'declined_cancelled']) }}" class="btn btn-sm {{ $activeStatus === 'declined_cancelled' ? 'btn-admin-gold' : 'btn-outline-secondary' }}">
                Declined / Cancelled ({{ $counts['declined_cancelled'] }})
            </a>
            <a href="{{ route('admin.bookings.page', ['old' => 1]) }}" class="btn btn-sm {{ $activeStatus === 'old' ? 'btn-admin-gold' : 'btn-outline-secondary' }}">
                Old ({{ $counts['old'] }})
            </a>
        </div>

        @forelse ($bookings as $booking)
            <div class="admin-panel category-card">
                <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <h5 class="mb-0">{{ $booking->full_name }}</h5>
                            <span class="badge {{ $statusBadge($booking->status) }}">{{ ucfirst($booking->status) }}</span>
                        </div>
                        <p class="text-muted small mb-1">
                            {{ $booking->category->title }} &middot; {{ $booking->package->name }} ({{ $booking->package->formattedPrice() }})
                        </p>
                        <p class="mb-0 small">
                            <i class="bi bi-calendar3 me-1"></i>{{ $booking->date->format('M j, Y') }}
                            &middot;
                            <i class="bi bi-clock me-1"></i>{{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }}–{{ $booking->endTime()->format('g:i A') }}
                            &middot;
                            <i class="bi bi-telephone me-1"></i>{{ $booking->phone }}
                        </p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a
                            href="https://wa.me/{{ preg_replace('/\D/', '', $booking->phone) }}?text={{ urlencode("Hi {$booking->full_name}, thank you for your {$booking->category->title} booking request for {$booking->date->format('M j, Y')} at {$booking->start_time}. We'd love to confirm the details with you!") }}"
                            target="_blank"
                            rel="noopener"
                            class="btn btn-sm"
                            style="background-color: #25d366; color: #fff;"
                        >
                            <i class="bi bi-whatsapp me-1"></i> WhatsApp
                        </a>

                        @if ($booking->status === 'pending')
                            <form method="POST" action="{{ route('admin.bookings.status', $booking) }}">
                                <input type="hidden" name="status" value="confirmed">
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="bi bi-check2 me-1"></i> Confirm
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.bookings.status', $booking) }}">
                                <input type="hidden" name="status" value="declined">
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-x-lg me-1"></i> Decline
                                </button>
                            </form>
                        @endif

                        @if ($booking->status === 'confirmed')
                            <button
                                type="button"
                                class="btn btn-sm btn-outline-secondary"
                                data-bs-toggle="modal"
                                data-bs-target="#rescheduleModal"
                                data-reschedule-url="{{ route('admin.bookings.reschedule', $booking) }}"
                                data-customer-name="{{ $booking->full_name }}"
                                data-current-date="{{ $booking->date->format('Y-m-d') }}"
                                data-current-time="{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}"
                            >
                                <i class="bi bi-calendar2-week me-1"></i> Reschedule
                            </button>

                            <form method="POST" action="{{ route('admin.bookings.status', $booking) }}">
                                <input type="hidden" name="status" value="cancelled">
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-slash-circle me-1"></i> Cancel
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <hr>

                <div class="row g-3">
                    <div class="col-md-7">
                        <p class="small fw-semibold mb-2">Details</p>
                        @if (empty($booking->details))
                            <p class="text-muted small mb-0">No additional details submitted.</p>
                        @else
                            <ul class="small text-muted mb-0 ps-3">
                                @foreach ($booking->details as $key => $value)
                                    @continue(is_null($value) || $value === '')
                                    <li>
                                        <span class="fw-semibold text-body">{{ \Illuminate\Support\Str::headline($key) }}:</span>
                                        {{ is_bool($value) ? ($value ? 'Yes' : 'No') : $value }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        <p class="small mb-0 mt-2">
                            <span class="fw-semibold">Share on social:</span> {{ $booking->share_on_social ? 'Yes' : 'No' }}
                        </p>
                    </div>

                    <div class="col-md-5">
                        @if ($booking->themes->isNotEmpty())
                            <p class="small fw-semibold mb-2">Chosen Themes</p>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($booking->themes as $theme)
                                    <img
                                        src="{{ $theme->image }}"
                                        alt="{{ $theme->name }}"
                                        title="{{ $theme->name }}"
                                        style="width: 48px; height: 48px; object-fit: cover; border-radius: 8px;"
                                    >
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted small mb-0">No themes selected.</p>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="admin-panel">
                <div class="empty-state">
                    <i class="bi bi-calendar-week"></i>
                    <p class="mb-0">
                        @switch($activeStatus)
                            @case('pending')
                                No pending bookings right now.
                                @break
                            @case('confirmed')
                                No confirmed bookings right now.
                                @break
                            @case('declined_cancelled')
                                No declined or cancelled bookings.
                                @break
                            @case('old')
                                No past bookings yet.
                                @break
                            @default
                                No bookings yet — they'll show up here as soon as customers book through the site.
                        @endswitch
                    </p>
                </div>
            </div>
        @endforelse

        <div class="modal fade" id="rescheduleModal" tabindex="-1" aria-labelledby="rescheduleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="rescheduleModalLabel">Reschedule Booking</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted small">
                            Rescheduling for <strong id="rescheduleBookingName"></strong>.
                        </p>
                        <div class="mb-3">
                            <label for="rescheduleDate" class="form-label small fw-semibold">New Date</label>
                            <input type="date" id="rescheduleDate" name="date" class="form-control" form="rescheduleForm" required>
                        </div>
                        <div class="mb-3">
                            <label for="rescheduleTime" class="form-label small fw-semibold">New Time</label>
                            <input type="time" id="rescheduleTime" name="time" class="form-control" form="rescheduleForm" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form method="POST" id="rescheduleForm">
                            <button type="submit" class="btn btn-admin-gold">Save New Time</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-alayout>
