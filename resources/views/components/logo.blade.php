{{--
    Brand logo image (navbar, footer). Uses the cropped, transparent-background
    copy of zeinab_abedallah_logo.png so it sits cleanly on the cream background.
--}}
@props(['class' => ''])

<a href="{{ route('home') }}" aria-label="{{ __('site.brand_name') }} — {{ __('site.nav.home') }}"
    class="site-logo {{ $class }}">
    <img src="/assets/images/zeinab_abedallah_logo_mark.png" alt="{{ __('site.brand_name') }}"
        class="site-logo-img" width="1091" height="588">
</a>
