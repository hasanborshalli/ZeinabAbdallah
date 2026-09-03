@php
    $otherLocale = app()->getLocale() === 'ar' ? 'en' : 'ar';
@endphp

<header class="site-navbar {{ $solid ? 'navbar-solid' : '' }}">
    <nav class="navbar navbar-expand-lg container-max">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="/assets/images/zeinab_abdallah_logo.jpg" alt="{{ __('site.brand_name') }}">
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainNav"
            aria-controls="mainNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="mainNav">
            <ul class="navbar-nav align-items-lg-center gap-lg-2">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        {{ __('site.nav.home') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/catalog">{{ __('site.nav.catalog') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/faq">{{ __('site.nav.faq') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">{{ __('site.nav.contact') }}</a>
                </li>
                <li class="nav-item mt-3 mt-lg-0 ms-lg-2">
                    <a class="btn-gold" href="/contact">{{ __('site.nav.book_session') }}</a>
                </li>
                <li class="nav-item mt-3 mt-lg-0 ms-lg-2">
                    <a class="lang-switch" href="{{ route('lang.switch', $otherLocale) }}">
                        {{ __('site.nav.lang_switch') }}
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
