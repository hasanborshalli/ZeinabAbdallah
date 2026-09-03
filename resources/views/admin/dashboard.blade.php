<x-alayout title="Dashboard">

    <main class="col-md-9 col-lg-10 admin-main">
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h1 class="admin-page-title h4">Welcome back, {{ explode(' ', auth()->user()->name)[0] ?? 'Zeinab' }}</h1>
                <p class="text-muted mb-0">Here's what's happening with your studio today.</p>
            </div>
        </div>

        <div class="row g-3 mb-4">
            @foreach ($stats as $stat)
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <span class="stat-card-icon"><i class="bi {{ $stat['icon'] }}"></i></span>
                        <div>
                            <div class="stat-card-value">{{ $stat['value'] }}</div>
                            <div class="stat-card-label">{{ $stat['label'] }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row g-3">
            <div class="col-lg-8">
                <div class="admin-panel h-100">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0">Recent Bookings</h5>
                        <a href="{{ route('admin.bookings.page') }}" class="small">View all</a>
                    </div>

                    @forelse ($recentBookings as $booking)
                        <div class="d-flex align-items-center justify-content-between gap-3 py-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                            <div>
                                <div class="fw-semibold small">{{ $booking->full_name }}</div>
                                <div class="text-muted small">
                                    {{ $booking->category->title }} &middot; {{ $booking->date->format('M j, Y') }}
                                </div>
                            </div>
                            <span class="badge {{ match ($booking->status) {
                                'confirmed' => 'text-bg-success',
                                'declined' => 'text-bg-danger',
                                default => 'text-bg-warning',
                            } }}">{{ ucfirst($booking->status) }}</span>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="bi bi-calendar2-check"></i>
                            <p class="mb-0">No bookings yet — they'll show up here as soon as the booking form goes live.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="col-lg-4">
                <div class="admin-panel h-100">
                    <h5 class="mb-3">Quick Links</h5>
                    <div class="d-grid gap-2">
                        <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-secondary text-start">
                            <i class="bi bi-house me-2"></i> View Public Site
                        </a>
                        <a href="{{ route('catalog') }}" target="_blank" class="btn btn-outline-secondary text-start">
                            <i class="bi bi-collection me-2"></i> View Catalog Page
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-alayout>
