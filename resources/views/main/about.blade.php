@php
$whatsappUrl = 'https://wa.me/96170866603';
@endphp

<x-layout :title="__('site.about_page.heading_pre') . ' ' . __('site.about_page.heading_accent') . ' — ' . __('site.brand_name')">

    {{-- 1. Intro --}}
    <section class="contact-hero">
        <div class="container-max">
            <header class="contact-hero-inner">
                <span class="section-eyebrow">{{ __('site.about_page.eyebrow') }}</span>
                <span class="section-rule" aria-hidden="true"></span>

                <h1 class="contact-heading">
                    {{ __('site.about_page.heading_pre') }}
                    <em class="accent-taupe">{{ __('site.about_page.heading_accent') }}</em>
                    <i class="bi bi-heart-fill contact-heading-heart" aria-hidden="true"></i>
                </h1>

                <p class="contact-intro-text">{{ __('site.about_page.intro') }}</p>
            </header>
        </div>
    </section>

    {{-- 2. Her story --}}
    <section class="about-section">
        <div class="container-max about-grid">
            <div class="about-photo-wrap">
                <img src="{{ asset('assets/images/zeinab-abedallah.jpeg') }}" alt="{{ __('site.about.image_caption') }}"
                    class="about-photo" loading="eager">
            </div>

            <div class="about-copy">
                <span class="section-eyebrow">{{ __('site.about_page.story.eyebrow') }}</span>
                <span class="section-rule" aria-hidden="true"></span>
                <h2 class="about-heading">{{ __('site.about_page.story.heading') }}</h2>
                <p class="about-script">{{ __('site.about.script') }}</p>

                @foreach (__('site.about_page.story.paragraphs') as $paragraph)
                <p class="about-text">{{ $paragraph }}</p>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 3. Moments with babies --}}
    <section class="moments-section">
        <div class="container-max">
            <header class="section-header-center">
                <div class="section-header-rule-row">
                    <span class="section-header-line" aria-hidden="true"></span>
                    <span class="section-eyebrow">{{ __('site.moments.eyebrow') }}</span>
                    <span class="section-header-line" aria-hidden="true"></span>
                </div>

                <h2 class="section-heading-lg">
                    {{ __('site.moments.heading_pre') }}
                    <br>
                    <em class="accent-taupe">{{ __('site.moments.heading_accent') }}</em>
                </h2>

                <p class="section-intro-text">{{ __('site.moments.intro') }}</p>
            </header>

            <div class="moments-grid">
                @for ($i = 1; $i <= 6; $i++)
                <div class="moments-cell">
                    <img src="{{ asset('assets/images/home/portfolio-' . $i . '.jpg') }}"
                        alt="{{ __('site.moments.image_caption') }}" loading="lazy" data-lightbox>
                </div>
                @endfor
            </div>
        </div>
    </section>

    {{-- 4. Trust strip --}}
    <x-trust-strip>
        <div class="about-page-cta-row">
            <a href="{{ route('booking') }}" class="btn-pill btn-pill-solid">
                {{ __('site.nav.book_session') }}
                <i class="bi bi-arrow-right"></i>
            </a>
            <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="btn-pill btn-pill-outline">
                <i class="bi bi-chat-dots"></i>
                {{ __('site.contact.cta_whatsapp') }}
            </a>
        </div>
    </x-trust-strip>

</x-layout>
