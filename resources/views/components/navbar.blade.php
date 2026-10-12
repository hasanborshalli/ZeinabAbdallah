@php
$otherLocale = app()->getLocale() === 'ar' ? 'en' : 'ar';

$navLinks = [
['label' => __('site.nav.home'), 'href' => route('home')],
['label' => __('site.nav.sessions'), 'href' => route('home') . '#sessions'],
['label' => __('site.nav.about'), 'href' => route('about')],
['label' => __('site.nav.contact'), 'href' => route('contact')],
];
@endphp

{{-- Holds the page down so the fixed bar never covers the content underneath it. --}}
<div class="site-navbar-spacer" aria-hidden="true"></div>

<header class="site-navbar">
    <div class="site-navbar-inner container-max">
        <x-logo />

        <nav class="site-nav-desktop" aria-label="{{ __('site.nav.home') }}">
            @foreach ($navLinks as $link)
            <a href="{{ $link['href'] }}"
                class="site-nav-link {{ $link['href'] === route('home') && request()->routeIs('home') ? 'active' : '' }}">
                {{ $link['label'] }}
            </a>
            @endforeach

            <a href="{{ route('lang.switch', $otherLocale) }}" class="site-nav-lang">
                {{ __('site.nav.lang_switch') }}
            </a>

            <a href="{{ route('booking') }}" class="site-nav-cta">
                {{ __('site.nav.book_session') }}
            </a>
        </nav>

        <button type="button" class="site-nav-toggle" data-nav-toggle aria-expanded="false" aria-controls="mobileNav"
            data-label-open="{{ __('site.nav.menu_open') }}" data-label-close="{{ __('site.nav.menu_close') }}"
            aria-label="{{ __('site.nav.menu_open') }}">
            <i class="bi bi-list" data-nav-icon-open></i>
            <i class="bi bi-x-lg" data-nav-icon-close hidden></i>
        </button>
    </div>

    {{-- A compact dropdown that only takes the height of its links. --}}
    <nav id="mobileNav" class="site-nav-mobile" aria-label="{{ __('site.nav.home') }}" hidden>
        <ul class="site-nav-mobile-list">
            @foreach ($navLinks as $link)
            <li>
                <a href="{{ $link['href'] }}" class="site-nav-mobile-link">{{ $link['label'] }}</a>
            </li>
            @endforeach
            <li>
                <a href="{{ route('lang.switch', $otherLocale) }}" class="site-nav-mobile-link">
                    {{ __('site.nav.lang_switch') }}
                </a>
            </li>
        </ul>
        <div class="site-nav-mobile-cta-wrap">
            <a href="{{ route('booking') }}" class="site-nav-mobile-cta">
                {{ __('site.nav.book_session') }}
            </a>
        </div>
    </nav>
</header>