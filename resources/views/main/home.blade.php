@php
    $tr = fn ($model, $field) => app()->getLocale() === 'ar' ? $model->{$field . '_ar'} : $model->$field;
@endphp

<x-layout>

    {{-- 1. Hero --}}
    <section class="hero" style="background-image: url('{{ $heroImage }}');">
        <div class="hero-content">
            <h1 class="hero-brand">{{ __('site.brand_name') }}</h1>
            <p class="hero-subtitle">{{ __('site.brand_tagline') }}</p>
            <p class="hero-tagline">{{ __('site.hero.tagline') }}</p>
            <a href="/contact" class="btn-gold">{{ __('site.hero.cta') }}</a>
        </div>

        <div class="scroll-cue">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M12 4v16m0 0l-6-6m6 6l6-6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
    </section>

    {{-- 2. Short Introduction --}}
    <section class="section bg-cream">
        <div class="container-max">
            <div class="row align-items-center gy-5">
                <div class="col-lg-5">
                    <div class="about-photo-placeholder">
                        <div>
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path d="M4 7h3l2-2h6l2 2h3a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1z" stroke="currentColor" stroke-width="1.3"/>
                                <circle cx="12" cy="13" r="3.5" stroke="currentColor" stroke-width="1.3"/>
                            </svg>
                            <div>{{ __('site.about.image_caption') }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <span class="eyebrow">{{ __('site.about.eyebrow') }}</span>
                    <h2 class="section-heading">{{ __('site.about.heading') }}</h2>
                    <hr class="divider-gold">
                    <p class="fs-5" style="color: var(--color-ink-soft); max-width: 560px;">
                        {{ __('site.about.text') }}
                    </p>

                    <div class="about-offer mt-4">
                        <span class="eyebrow">{{ __('site.about.offer_eyebrow') }}</span>
                        <h3 class="section-heading fs-3">{{ __('site.about.offer_heading') }}</h3>
                        <hr class="divider-gold">
                        <p class="fs-5" style="color: var(--color-ink-soft); max-width: 560px;">
                            {{ __('site.about.offer_text') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. Choose Your Session --}}
    <section class="section">
        <div class="container-max">
            <div class="section-intro mx-auto text-center mb-5">
                <span class="eyebrow">{{ __('site.sessions.eyebrow') }}</span>
                <h2 class="section-heading">{{ __('site.sessions.heading') }}</h2>
                <hr class="divider-gold">
            </div>

            <div class="row g-3 g-md-4">
                @foreach ($sessions as $category)
                    <div class="col-6 col-lg-3">
                        <a href="/catalog#cat-{{ $category->id }}" class="session-card" style="background-image: url('{{ $category->main_image }}');">
                            <div class="session-card-body">
                                <i class="session-card-icon bi {{ $category->icon }}"></i>
                                <div class="session-card-title">{{ $tr($category, 'title') }}</div>
                                <span class="session-card-link">{{ __('site.sessions.cta') }} &rarr;</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 4. Portfolio --}}
    <section class="section bg-cream">
        <div class="container-max">
            <div class="section-intro mx-auto text-center mb-5">
                <span class="eyebrow">{{ __('site.portfolio.eyebrow') }}</span>
                <h2 class="section-heading">{{ __('site.portfolio.heading') }}</h2>
                <hr class="divider-gold">
            </div>

            <div class="portfolio-grid">
                @foreach ($portfolio as $item)
                    <div class="portfolio-item {{ $item['tall'] ? 'tall' : '' }}">
                        <img src="{{ $item['image'] }}" alt="{{ __('site.portfolio.heading') }}" loading="lazy">
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5">
                <a href="/catalog" class="btn-outline-gold">{{ __('site.portfolio.cta') }}</a>
            </div>
        </div>
    </section>

    {{-- 5. The Experience --}}
    <section class="section">
        <div class="container-max">
            <div class="section-intro mx-auto text-center mb-5">
                <span class="eyebrow">{{ __('site.experience.eyebrow') }}</span>
                <h2 class="section-heading">{{ __('site.experience.heading') }}</h2>
                <hr class="divider-gold">
            </div>

            <div class="row g-4">
                @foreach (__('site.experience.steps') as $step)
                    <div class="col-6 col-lg-3">
                        <div class="experience-step">
                            <div class="experience-step-number">{{ $step['number'] }}</div>
                            <div class="experience-step-title">{{ $step['title'] }}</div>
                            <p class="experience-step-text">{{ $step['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 6. Packages teaser --}}
    <section class="packages-band">
        <div class="container-max">
            <span class="eyebrow">{{ __('site.packages.eyebrow') }}</span>
            <h2 class="section-heading mx-auto" style="max-width: 620px;">{{ __('site.packages.heading') }}</h2>
            <a href="/catalog" class="link-gold fs-5">{{ __('site.packages.cta') }} &rarr;</a>
        </div>
    </section>

    {{-- 7. Gift Vouchers --}}
    <section class="section bg-cream">
        <div class="container-max">
            <div class="voucher-band mx-auto text-center">
                <span class="eyebrow">{{ __('site.vouchers.eyebrow') }}</span>
                <h2 class="section-heading">{{ __('site.vouchers.heading') }}</h2>
                <hr class="divider-gold mx-auto">
                <p class="fs-5" style="color: var(--color-ink-soft);">{{ __('site.vouchers.text') }}</p>
                <p class="fs-5" style="color: var(--color-ink-soft);">{{ __('site.vouchers.text_2') }}</p>
                <div class="voucher-actions">
                    <a href="/contact" class="btn-gold">{{ __('site.vouchers.cta_primary') }}</a>
                    <a href="/contact" class="btn-outline-gold">{{ __('site.vouchers.cta_secondary') }}</a>
                </div>
            </div>
        </div>
    </section>

    {{-- 8. Reviews --}}
    <section class="section">
        <div class="container-max">
            <div class="section-intro mx-auto text-center mb-5">
                <span class="eyebrow">{{ __('site.reviews.eyebrow') }}</span>
                <h2 class="section-heading">{{ __('site.reviews.heading') }}</h2>
                <hr class="divider-gold">
            </div>

            <div class="row g-4">
                @foreach (__('site.reviews.items') as $review)
                    <div class="col-md-6 col-lg-3">
                        <div class="review-card">
                            <span class="review-quote-mark">&ldquo;</span>
                            <p class="review-text">{{ $review['text'] }}</p>
                            <p class="review-name">{{ $review['name'] }}</p>
                            <span class="review-role">{{ $review['role'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 9. FAQ teaser --}}
    <section class="section bg-cream">
        <div class="container-max">
            <div class="section-intro mx-auto text-center">
                <span class="eyebrow">{{ __('site.faq.eyebrow') }}</span>
                <h2 class="section-heading">{{ __('site.faq.help_heading') }}</h2>
                <hr class="divider-gold">
                <p class="fs-5" style="color: var(--color-ink-soft);">{{ __('site.faq.help_text') }}</p>
                <a href="/faq" class="btn-gold mt-3">{{ __('site.faq.view_all') }}</a>
            </div>
        </div>
    </section>

    {{-- 10. Final CTA --}}
    <section class="final-cta" style="background-image: url('{{ $finalCtaImage }}');">
        <div class="final-cta-content">
            <h2 class="final-cta-heading">{{ __('site.final_cta.heading') }}</h2>
            <p class="final-cta-subheading">{{ __('site.final_cta.subheading') }}</p>
            <a href="/contact" class="btn-gold">{{ __('site.final_cta.cta') }}</a>
        </div>
    </section>

</x-layout>
