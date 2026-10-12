@php
$tr = fn ($model, $field) => app()->getLocale() === 'ar' ? $model->{$field . '_ar'} : $model->$field;
$whatsappUrl = 'https://wa.me/96170866603';
@endphp

<x-layout>

    {{-- 1. Hero --}}
    <section id="top" class="hero-new" aria-label="{{ __('site.brand_name') }}">
        <img src="{{ asset('assets/images/hero/hero-mobile.jpg') }}" alt="{{ __('site.hero.image_caption') }}"
            class="hero-bg-img hero-bg-img-mobile" loading="eager">
        <img src="{{ asset('assets/images/hero/hero-desktop.jpg') }}" alt="" aria-hidden="true"
            class="hero-bg-img hero-bg-img-desktop" loading="eager">

        <div class="hero-veil" aria-hidden="true"></div>

        <div class="container-max hero-inner">
            <div class="hero-copy">
                <span class="hero-eyebrow">{{ __('site.brand_tagline') }}</span>
                <span class="hero-rule" aria-hidden="true"></span>

                <p class="hero-script">
                    {{ __('site.hero.welcome') }}
                    <i class="bi bi-heart"></i>
                </p>
                <p class="hero-kicker">{{ __('site.hero.kicker') }}</p>

                <h1 class="hero-heading">
                    {{ __('site.hero.heading_pre') }}
                    <br>
                    <em class="accent-taupe">{{ __('site.hero.heading_accent') }}</em>
                    <br>
                    {{ __('site.hero.heading_post') }}
                </h1>

                <p class="hero-text">{{ __('site.hero.text') }}</p>

                <div class="hero-actions">
                    <a href="#sessions" class="btn-pill btn-pill-solid">
                        {{ __('site.hero.cta_primary') }}
                        <i class="bi bi-arrow-right"></i>
                    </a>
                    <a href="{{ route('gallery') }}" class="btn-pill btn-pill-outline">
                        {{ __('site.hero.cta_secondary') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- 2. Trust strip --}}
    <x-trust-strip />

    {{-- 3. Sessions ("What I offer") --}}
    <section id="sessions" class="sessions-section">
        <div class="container-max">
            <header class="section-header-center">
                <div class="section-header-rule-row">
                    <span class="section-header-line" aria-hidden="true"></span>
                    <span class="section-eyebrow">{{ __('site.sessions.eyebrow') }}</span>
                    <span class="section-header-line" aria-hidden="true"></span>
                </div>

                <h2 class="section-heading-lg">
                    {{ __('site.sessions.heading_pre') }}
                    <br>
                    <em class="accent-taupe">{{ __('site.sessions.heading_accent') }}</em>
                </h2>

                <p class="section-intro-text">{{ __('site.sessions.intro') }}</p>
            </header>

            <ul class="sessions-grid">
                @foreach ($sessions as $i => $category)
                <li class="{{ $i === 0 ? 'sessions-grid-featured' : '' }}">
                    <article class="session-card">
                        <img src="{{ $category->main_image }}" alt="{{ $tr($category, 'title') }}"
                            class="session-card-img" loading="lazy">
                        <div class="session-card-veil" aria-hidden="true"></div>

                        <div class="session-card-body">
                            <span class="session-card-rule" aria-hidden="true"></span>

                            <h3 class="session-card-name {{ $i === 0 ? 'session-card-name-featured' : '' }}">
                                {{ $tr($category, 'title') }}
                            </h3>

                            @if ($tr($category, 'small_description'))
                            <span class="session-card-highlight">
                                {{ $tr($category, 'small_description') }}
                            </span>
                            @endif

                            @if ($tr($category, 'description'))
                            <p class="session-card-desc">{{ $tr($category, 'description') }}</p>
                            @endif

                            <a href="{{ route('sessions.show', $category->slug) }}" class="session-card-cta">
                                {{ __('site.sessions.card_cta') }}
                                <i class="bi bi-arrow-right"></i>
                                <span class="visually-hidden">{{ $tr($category, 'title') }}</span>
                            </a>
                        </div>
                    </article>
                </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- 4. About ("Who I am") --}}
    <section id="about" class="about-section">
        <div class="container-max about-grid">


            <div class="about-photo-wrap">
                <img src="{{ asset('assets/images/zeinab-abedallah.jpeg') }}" alt="{{ __('site.about.image_caption') }}"
                    class="about-photo" loading="lazy">
            </div>

            <div class="about-copy">


                <span class="section-eyebrow">{{ __('site.about.eyebrow') }}</span>
                <span class="section-rule" aria-hidden="true"></span>
                <h2 class="about-heading">{{ __('site.about.heading') }}</h2>
                <p class="about-script">{{ __('site.about.script') }}</p>
                <p class="about-text">{{ __('site.about.text') }}</p>

                <div class="about-cta-row">
                    <a href="{{ route('about') }}" class="btn-pill btn-pill-solid about-cta">
                        {{ __('site.about.more_cta') }}
                        <i class="bi bi-arrow-right"></i>
                    </a>
                    <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="btn-pill btn-pill-outline about-cta">
                        {{ __('site.about.cta') }}
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Feedbacks --}}
    @if ($feedbacks->isNotEmpty())
    <section id="feedbacks" class="feedbacks-section">
        <div class="container-max">
            <header class="section-header-center">
                <div class="section-header-rule-row">
                    <span class="section-header-line" aria-hidden="true"></span>
                    <span class="section-eyebrow">{{ __('site.feedbacks.eyebrow') }}</span>
                    <span class="section-header-line" aria-hidden="true"></span>
                </div>

                <h2 class="section-heading-lg">
                    {{ __('site.feedbacks.heading_pre') }}
                    <br>
                    <em class="accent-taupe">{{ __('site.feedbacks.heading_accent') }}</em>
                </h2>

                <p class="section-intro-text">{{ __('site.feedbacks.intro') }}</p>
            </header>

            <div class="feedbacks-slider">
                <button type="button" class="feedbacks-slider-arrow feedbacks-slider-prev" data-feedbacks-prev
                    aria-label="{{ __('site.feedbacks.prev') }}">
                    <i class="bi bi-chevron-left"></i>
                </button>

                <ul class="feedbacks-track" data-feedbacks-track>
                    @foreach ($feedbacks as $feedback)
                    <li class="feedbacks-slide">
                        <article class="feedback-card">
                            <i class="bi bi-quote feedback-card-icon" aria-hidden="true"></i>
                            <p class="feedback-card-text">{{ $tr($feedback, 'feedback') }}</p>
                            <span class="feedback-card-rule" aria-hidden="true"></span>
                            <p class="feedback-card-name">{{ $tr($feedback, 'name') }}</p>
                        </article>
                    </li>
                    @endforeach
                </ul>

                <button type="button" class="feedbacks-slider-arrow feedbacks-slider-next" data-feedbacks-next
                    aria-label="{{ __('site.feedbacks.next') }}">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>
    @endif

    {{-- Why choose me --}}
    <section id="why-choose" class="why-choose-section">
        <div class="container-max">
            <header class="section-header-center">
                <div class="section-header-rule-row">
                    <span class="section-header-line" aria-hidden="true"></span>
                    <span class="section-eyebrow">{{ __('site.why_choose.eyebrow') }}</span>
                    <span class="section-header-line" aria-hidden="true"></span>
                </div>

                <h2 class="section-heading-lg">
                    {{ __('site.why_choose.heading_pre') }}
                    <em class="accent-taupe">{{ __('site.why_choose.heading_accent') }}</em>
                </h2>

                <p class="section-intro-text">{{ __('site.why_choose.intro') }}</p>
            </header>

            <ul class="why-choose-grid">
                @foreach (__('site.why_choose.items') as $item)
                <li>
                    <article class="why-choose-card">
                        <span class="why-choose-card-icon" aria-hidden="true">
                            <i class="bi {{ $item['icon'] }}"></i>
                        </span>
                        <div>
                            <h3 class="why-choose-card-title">{{ $item['title'] }}</h3>
                            <p class="why-choose-card-text">{{ $item['text'] }}</p>
                        </div>
                    </article>
                </li>
                @endforeach
            </ul>

            <p class="why-choose-quote">&ldquo;{!! __('site.why_choose.quote') !!}&rdquo;</p>
        </div>
    </section>

</x-layout>