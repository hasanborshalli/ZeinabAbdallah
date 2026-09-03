<div
    class="admin-sidebar-col col-md-3 col-lg-2 p-0 bg-white border-end shadow-sm d-md-flex flex-column position-md-sticky top-0">
    <div class="offcanvas-md offcanvas-start bg-white" tabindex="-1" id="sidebarMenu"
        aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header border-bottom d-md-none">
            <h5 class="offcanvas-title fw-semibold" id="sidebarMenuLabel">Youphoto Admin</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                aria-label="Close"></button>
        </div>

        <div class="offcanvas-body d-md-flex flex-column p-0 h-100">
            <nav class="flex-grow-1 overflow-y-auto px-3 py-4">
                <p class="text-uppercase text-muted small fw-semibold mb-2 px-2">Overview</p>
                <ul class="nav nav-pills flex-column gap-1 mb-4">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 rounded-3 py-2 px-3 {{ request()->routeIs('admin.dashboard') ? 'active text-white' : 'text-body-secondary' }}"
                            aria-current="{{ request()->routeIs('admin.dashboard') ? 'page' : 'false' }}"
                            href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard Home</span>
                        </a>
                    </li>
                </ul>

                <p class="text-uppercase text-muted small fw-semibold mb-2 px-2">Bookings</p>
                <ul class="nav nav-pills flex-column gap-1 mb-4">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 rounded-3 py-2 px-3 {{ request()->routeIs('admin.bookings.page') && !request('status') ? 'active text-white' : 'text-body-secondary' }}"
                            aria-current="{{ request()->routeIs('admin.bookings.page') && !request('status') ? 'page' : 'false' }}"
                            href="{{ route('admin.bookings.page') }}">
                            <i class="bi bi-calendar-week"></i>
                            <span>Bookings</span>
                        </a>
                    </li>

                </ul>

                <p class="text-uppercase text-muted small fw-semibold mb-2 px-2">Catalog</p>
                <ul class="nav nav-pills flex-column gap-1 mb-4">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 rounded-3 py-2 px-3 {{ request()->routeIs('admin.categories.*') ? 'active text-white' : 'text-body-secondary' }}"
                            aria-current="{{ request()->routeIs('admin.categories.*') ? 'page' : 'false' }}"
                            href="{{ route('admin.categories.page') }}">
                            <i class="bi bi-collection"></i>
                            <span>Categories & Packages</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 rounded-3 py-2 px-3 {{ request()->routeIs('admin.themes.*') ? 'active text-white' : 'text-body-secondary' }}"
                            aria-current="{{ request()->routeIs('admin.themes.*') ? 'page' : 'false' }}"
                            href="{{ route('admin.themes.page') }}">
                            <i class="bi bi-palette"></i>
                            <span>Themes</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 rounded-3 py-2 px-3 {{ request()->routeIs('admin.gallery.*') ? 'active text-white' : 'text-body-secondary' }}"
                            href="{{ route('admin.gallery.page') }}"
                            aria-current="{{ request()->routeIs('admin.gallery.*') ? 'page' : 'false' }}">
                            <i class=" bi bi-images"></i>
                            <span>Photo Gallery</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 rounded-3 py-2 px-3 {{ request()->routeIs('admin.homeImage.*') ? 'active text-white' : 'text-body-secondary' }}"
                            href="{{ route('admin.homeImage.page') }}"
                            aria-current="{{ request()->routeIs('admin.homeImage.*') ? 'page' : 'false' }}">
                            <i class="bi bi-house-heart"></i>
                            <span>Home Images</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 rounded-3 py-2 px-3 {{ request()->routeIs('admin.questions.*') ? 'active text-white' : 'text-body-secondary' }}"
                            href="{{ route('admin.questions.page') }}"
                            aria-current="{{ request()->routeIs('admin.questions.*') ? 'page' : 'false' }}">
                            <i class="bi bi-question-circle"></i>
                            <span>FAQ Questions</span>
                        </a>
                    </li>
                </ul>

                <p class="text-uppercase text-muted small fw-semibold mb-2 px-2">Settings</p>
                <ul class="nav nav-pills flex-column gap-1">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 rounded-3 py-2 px-3 {{ request()->routeIs('admin.schedule.*') ? 'active text-white' : 'text-body-secondary' }}"
                            aria-current="{{ request()->routeIs('admin.schedule.*') ? 'page' : 'false' }}"
                            href="{{ route('admin.schedule.page') }}">
                            <i class="bi bi-calendar-week"></i>
                            <span>My Schedule</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 rounded-3 py-2 px-3 {{ request()->routeIs('admin.account.*') ? 'active text-white' : 'text-body-secondary' }}"
                            aria-current="{{ request()->routeIs('admin.account.*') ? 'page' : 'false' }}"
                            href="{{ route('admin.account.page') }}">
                            <i class="bi bi-gear"></i>
                            <span>Account</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="mt-auto p-3 border-top bg-body-tertiary flex-shrink-0">
                <div class="d-flex align-items-center gap-3 p-2 rounded-3 bg-white border mb-3">
                    <span
                        class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary p-2 flex-shrink-0">
                        <i class="bi bi-person-fill"></i>
                    </span>
                    <div class="overflow-hidden">
                        <div class="fw-semibold small text-truncate">{{ auth()->user()->name ?? 'Admin' }}</div>
                        <div class="text-muted small text-truncate">{{ auth()->user()->email ?? '' }}</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    <button type="submit"
                        class="btn btn-outline-danger w-100 rounded-3 d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-box-arrow-right"></i>
                        Sign out
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>