{{--
    Text-based brand mark (no logo image). `tone="light"` renders for dark/sage
    backgrounds; default `tone="dark"` renders for the cream background used
    everywhere else (navbar, footer).
--}}
@props(['tone' => 'dark', 'class' => ''])

<a href="{{ route('home') }}" aria-label="{{ __('site.brand_name') }} — {{ __('site.nav.home') }}"
    class="site-logo {{ $tone === 'light' ? 'site-logo-light' : '' }} {{ $class }}">
    <x-flourish />
    <span class="site-logo-name">{{ __('site.brand_name') }}</span>
    <span class="site-logo-sub">{{ __('site.brand_by') }}</span>
</a>
