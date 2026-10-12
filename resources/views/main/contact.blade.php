@php
    $directionsUrl = 'https://www.google.com/maps/search/?api=1&query=' . urlencode('Jamhour Residents Block A, Hazmieh, Lebanon');
    $whatsappUrl = 'https://wa.me/96170866603';
    $phoneUrl = 'tel:+96170866603';
    $email = 'z.abedallah@gmail.com';
    $instagramUrl = 'https://www.instagram.com/youphoto.lb';

    $channels = [
        ['icon' => 'bi-whatsapp', 'key' => 'whatsapp', 'href' => $whatsappUrl, 'value' => __('site.contact.phone_display'), 'external' => true, 'featured' => true],
        ['icon' => 'bi-telephone', 'key' => 'phone', 'href' => $phoneUrl, 'value' => __('site.contact.phone_display'), 'external' => false, 'featured' => false],
        ['icon' => 'bi-envelope', 'key' => 'email', 'href' => 'mailto:' . $email, 'value' => $email, 'external' => false, 'featured' => false],
        ['icon' => 'bi-instagram', 'key' => 'instagram', 'href' => $instagramUrl, 'value' => __('site.contact.instagram_handle'), 'external' => true, 'featured' => false],
    ];
@endphp

<x-layout :title="__('site.contact.heading_pre') . ' ' . __('site.contact.heading_accent') . ' — ' . __('site.brand_name')">

    {{-- 1. Intro --}}
    <section class="contact-hero contact-hero--shell">
        <div class="container-max">
            <header class="contact-hero-inner">
                <span class="contact-eyebrow">
                    <i class="bi bi-heart" aria-hidden="true"></i>
                    {{ __('site.contact.eyebrow') }}
                    <i class="bi bi-heart" aria-hidden="true"></i>
                </span>

                <h1 class="contact-heading contact-heading--lg">
                    {{ __('site.contact.heading_pre') }}
                    <em class="accent-taupe">{{ __('site.contact.heading_accent') }}</em>
                </h1>

                <p class="contact-intro-text">{{ __('site.contact.intro') }}</p>

                <div class="contact-cta-row">
                    <a href="{{ route('booking') }}" class="btn-pill btn-pill-solid">
                        <i class="bi bi-calendar-heart"></i>
                        {{ __('site.contact.cta_booking') }}
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </header>
        </div>
    </section>

    {{-- 2. Reach out --}}
    <section class="contact-reach" aria-labelledby="reach-out-title">
        <div class="container-max">
            <header class="contact-section-header">
                <h2 id="reach-out-title" class="contact-studio-heading">
                    {{ __('site.contact.reach.heading_pre') }}
                    <em class="accent-taupe">{{ __('site.contact.reach.heading_accent') }}</em>
                </h2>
                <p>{{ __('site.contact.reach.intro') }}</p>
            </header>

            <div class="contact-channel-grid">
                @foreach ($channels as $channel)
                    <a href="{{ $channel['href'] }}"
                        @if ($channel['external']) target="_blank" rel="noopener" @endif
                        class="contact-channel {{ $channel['featured'] ? 'contact-channel--featured' : '' }}">
                        <span class="contact-icon-circle"><i class="bi {{ $channel['icon'] }}"></i></span>
                        <span class="contact-channel-text">
                            <span class="contact-channel-title">{{ __('site.contact.reach.' . $channel['key'] . '_title') }}</span>
                            <span class="contact-channel-sub">{{ __('site.contact.reach.' . $channel['key'] . '_sub') }}</span>
                        </span>
                        <span class="contact-channel-value" dir="ltr">{{ $channel['value'] }}</span>
                        <i class="bi bi-chevron-right contact-chevron" aria-hidden="true"></i>
                    </a>
                @endforeach
            </div>

            <div class="contact-divider" aria-hidden="true">
                <span></span><i class="bi bi-heart"></i><span></span>
            </div>
        </div>
    </section>

    {{-- 3. Studio Information --}}
    <section class="contact-studio" aria-labelledby="studio-info-title">
        <div class="container-max">
            <header class="contact-section-header">
                <h2 id="studio-info-title" class="contact-studio-heading">
                    {{ __('site.contact.studio.heading_pre') }}
                    <em class="accent-taupe">{{ __('site.contact.studio.heading_accent') }}</em>
                </h2>
                <p>{{ __('site.contact.studio.intro') }}</p>
            </header>

            <div class="contact-studio-grid">
                <article class="contact-info-card">
                    <span class="contact-icon-circle"><i class="bi bi-clock"></i></span>
                    <div class="contact-info-body">
                        <h3>{{ __('site.contact.studio.hours_title') }}</h3>
                        <p class="contact-info-sub">{{ __('site.contact.studio.hours_days') }}</p>
                        <p class="contact-info-time">{{ __('site.contact.studio.hours_time') }}</p>
                        <p class="contact-info-note">{{ __('site.contact.studio.hours_note') }}</p>
                    </div>
                </article>

                <a href="{{ $directionsUrl }}" target="_blank" rel="noopener"
                    class="contact-info-card contact-info-card--link"
                    aria-label="{{ __('site.contact.studio.directions_cta') }}: {{ __('site.contact.studio.location_address') }}">
                    <span class="contact-icon-circle"><i class="bi bi-geo-alt"></i></span>
                    <div class="contact-info-body">
                        <h3>{{ __('site.contact.studio.location_title') }}</h3>
                        <p class="contact-info-sub">{{ __('site.contact.studio.location_address') }}</p>
                    </div>
                    <i class="bi bi-chevron-right contact-chevron" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>

</x-layout>
