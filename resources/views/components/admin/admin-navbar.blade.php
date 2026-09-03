<header class="navbar navbar-expand-md navbar-light bg-white border-bottom shadow sticky-top px-3">
    <a class="navbar-brand fs-6 text-dark fw-semibold lh-sm d-flex align-items-center gap-2" href="{{ route('admin.dashboard') }}">
        <img src="/assets/images/zeinab_abdallah_logo.jpg" alt="Youphoto" height="28" class="rounded-circle">
        Youphoto Admin
    </a>
    <div class="ms-auto d-none d-md-flex align-items-center">
        <a class="nav-link text-dark small fw-medium px-2" href="{{ route('home') }}" target="_blank">
            <i class="bi bi-arrow-left-circle me-1"></i>
            Back to main site
        </a>
    </div>
    <button class="navbar-toggler d-md-none border-0 shadow-none ms-auto" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</header>