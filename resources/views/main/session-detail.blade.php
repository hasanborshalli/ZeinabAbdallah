@php
$tr = fn ($model, $field) => app()->getLocale() === 'ar' ? $model->{$field . '_ar'} : $model->$field;
$whatsappUrl = 'https://wa.me/96170866603';
$categoryTitle = $tr($category, 'title');
@endphp

<x-layout :title="$categoryTitle . ' ' . __('site.session_detail.title_suffix') . ' — ' . __('site.brand_name')">

    <div class="container-max sd-back-wrap">
        <a href="{{ route('home') }}#sessions" class="sd-back-link">
            <i class="bi bi-arrow-left"></i>
            {{ __('site.session_detail.back_link') }}
        </a>
    </div>

    {{-- Photography / intro --}}
    <section id="photography" class="sd-photography">
        <div class="container-max">
            <header class="section-header-center">
                <span class="section-eyebrow">{{ $categoryTitle }} {{ __('site.session_detail.title_suffix') }}</span>
                <span class="section-rule mx-auto" aria-hidden="true"></span>

                <h1 class="sd-title">
                    <em class="accent-taupe">{{ $categoryTitle }}</em>
                    {{ __('site.session_detail.title_suffix') }}
                </h1>

                @if ($tr($category, 'description'))
                <p class="section-intro-text">{{ $tr($category, 'description') }}</p>
                @endif
            </header>

            @if ($category->images->isNotEmpty())
            <div class="sd-gallery-grid">
                @foreach ($category->images as $i => $photo)
                <div
                    class="sd-gallery-cell {{ $i === 0 ? 'sd-gallery-cell-featured' : '' }} {{ $i > 2 ? 'sd-gallery-cell-extra' : '' }}">
                    <img src="{{ $photo->image }}" alt="{{ $categoryTitle }}"
                        loading="{{ $i === 0 ? 'eager' : 'lazy' }}" data-lightbox>
                </div>
                @endforeach
            </div>

            <div class="sd-gallery-cta-wrap">
                <a href="{{ route('sessions.gallery', $category->slug) }}" class="sd-gallery-cta">
                    {{ __('site.session_detail.gallery_cta') }}
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            @elseif ($category->main_image)
            <div class="sd-gallery-grid sd-gallery-grid-single">
                <div class="sd-gallery-cell sd-gallery-cell-featured">
                    <img src="{{ $category->main_image }}" alt="{{ $categoryTitle }}" loading="eager" data-lightbox>
                </div>
            </div>
            @endif

            <div class="sd-photography-footer">
                <a href="#packages" class="sd-view-packages-link">
                    {{ __('site.session_detail.view_packages_link') }}
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- Packages --}}
    <section id="packages" class="sd-packages">
        <div class="container-max">
            <header class="section-header-center">
                <h2 class="section-heading-lg">
                    {{ __('site.session_detail.packages_heading_pre') }}
                    <em class="accent-taupe">{{ __('site.session_detail.packages_heading_accent') }}</em>
                </h2>

                <div class="sd-heart-rule">
                    <span></span>
                    <i class="bi bi-heart"></i>
                    <span></span>
                </div>

                <p class="section-intro-text">{{ __('site.session_detail.packages_intro') }}</p>
            </header>

            @if ($category->packages->isNotEmpty())
            <ul class="sd-packages-grid">
                @foreach ($category->packages as $package)
                @php
                $bookingUrl = route('booking', [
                'session' => $categoryTitle,
                'package' => $tr($package, 'name'),
                ]);
                @endphp
                <li>
                    <article class="sd-package-card">
                        <h3 class="sd-package-name">{{ $tr($package, 'name') }}</h3>

                        <p class="sd-package-duration">
                            <i class="bi bi-clock"></i>
                            {{ $package->durationLabel() }}
                        </p>

                        <p class="sd-package-price">{{ $package->formattedPrice() }}</p>
                        <span class="sd-package-rule" aria-hidden="true"></span>

                        @if ($package->features->isNotEmpty())
                        <ul class="sd-package-features">
                            @foreach ($package->features as $feature)
                            <li>
                                <i class="bi bi-check-lg"></i>
                                <span>{{ $tr($feature, 'description') }}</span>
                            </li>
                            @endforeach
                        </ul>
                        @endif

                        <a href="{{ $bookingUrl }}" class="sd-package-cta">
                            <i class="bi bi-calendar-event"></i>
                            {{ __('site.session_detail.book_now') }}
                            <i class="bi bi-arrow-right"></i>
                            <span class="visually-hidden">— {{ $tr($package, 'name') }}</span>
                        </a>
                    </article>
                </li>
                @endforeach
            </ul>
            @endif
        </div>
    </section>

    {{-- Themes --}}
    @if ($category->themes->isNotEmpty())
    <section id="themes" class="sd-themes-section">
        <div class="container-max">
            <header class="section-header-center">
                <h2 class="section-heading-lg">
                    {{ __('site.session_detail.themes_heading_pre') }}
                    <em class="accent-taupe">{{ __('site.session_detail.themes_heading_accent') }}</em>
                </h2>
                <p class="section-intro-text">{{ __('site.session_detail.themes_intro') }}</p>
            </header>

            <ul class="sd-themes-grid">
                @foreach ($category->themes->take(4) as $theme)
                <li class="sd-theme-chip">
                    <img src="{{ $theme->image }}" alt="{{ $tr($theme, 'name') }}" loading="lazy" data-lightbox>
                    <span class="sd-theme-chip-name">{{ $tr($theme, 'name') }}</span>
                </li>
                @endforeach
            </ul>

            <div class="sd-gallery-cta-wrap">
                <a href="{{ route('sessions.themes', $category->slug) }}" class="sd-gallery-cta">
                    {{ __('site.themes_page.browse_all') }}
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- Notes --}}
    @if ($category->notes->isNotEmpty())
    <section id="notes" class="sd-notes-section">
        <div class="container-max">
            <div class="sd-notes-card">
                <h2 class="sd-notes-heading">
                    {{ __('site.session_detail.notes_heading_pre') }}
                    <em class="accent-taupe">{{ __('site.session_detail.notes_heading_accent') }}</em>
                    <i class="bi bi-heart-fill sd-notes-heart"></i>
                </h2>

                <div class="sd-notes-caption-row">
                    <span class="sd-notes-caption">{{ __('site.session_detail.notes_caption') }}</span>
                    <span class="sd-notes-caption-rule" aria-hidden="true"></span>
                </div>

                <ul class="sd-notes-list">
                    @foreach ($category->notes as $note)
                    <li>
                        <i class="bi bi-check2-circle"></i>
                        <p>{{ $tr($note, 'note') }}</p>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
    @endif

    @if ($tr($category, 'highlight'))
    <div class="container-max sd-highlight-lead">

        <p class="sd-script">
            {{ $tr($category, 'highlight') }}

        </p>
    </div>
    @endif

    {{-- FAQs --}}
    @if ($faqs->isNotEmpty())
    <section id="faq" class="sd-faqs-section">
        <div class="container-max sd-faqs-inner">
            <header class="section-header-center">
                <span class="sd-faqs-badge">
                    <i class="bi bi-question-circle"></i>
                    {{ __('site.session_detail.faqs_badge') }}
                </span>

                <h2 class="section-heading-lg">
                    {{ __('site.session_detail.faqs_heading_pre') }}
                    <br>
                    <em class="accent-taupe">{{ __('site.session_detail.faqs_heading_accent') }}</em>
                    <i class="bi bi-heart-fill sd-faqs-heart"></i>
                </h2>

                <div class="sd-heart-rule sd-heart-rule-sm">
                    <span></span>
                    <i class="bi bi-heart"></i>
                    <span></span>
                </div>

                <p class="section-intro-text">{{ __('site.session_detail.faqs_intro') }}</p>
            </header>

            <ul class="sd-faqs-list">
                @foreach ($faqs as $faq)
                <li>
                    <details class="sd-faq-item">
                        <summary class="sd-faq-question">
                            <span>{{ $tr($faq, 'question') }}</span>
                            <i class="bi bi-chevron-down sd-faq-chevron"></i>
                        </summary>
                        <p class="sd-faq-answer">{{ $tr($faq, 'answer') }}</p>
                    </details>
                </li>
                @endforeach
            </ul>
        </div>
    </section>
    @endif

    {{-- Contact CTA --}}
    <section id="contact-session" class="sd-contact-section">
        <div class="container-max sd-contact-inner">
            <span class="sd-contact-icon" aria-hidden="true">
                <i class="bi bi-question-circle"></i>
            </span>

            <h2 class="section-heading-lg">
                {{ __('site.session_detail.contact_heading_pre') }}
                <em class="accent-taupe">{{ __('site.session_detail.contact_heading_accent') }}</em>
                <i class="bi bi-heart-fill sd-contact-heart"></i>
            </h2>

            <p class="section-intro-text">{{ __('site.session_detail.contact_intro') }}</p>

            <div class="sd-contact-actions">
                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="btn-pill btn-pill-solid">
                    <i class="bi bi-chat-dots"></i>
                    {{ __('site.session_detail.contact_cta_whatsapp') }}
                    <i class="bi bi-arrow-right"></i>
                </a>
                <a href="{{ route('contact') }}" class="btn-pill btn-pill-outline">
                    <i class="bi bi-envelope"></i>
                    {{ __('site.session_detail.contact_cta_page') }}
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <p class="sd-contact-script">
                {{ __('site.session_detail.contact_closing_script') }}
                <i class="bi bi-heart"></i>
            </p>
        </div>
    </section>

    {{-- Gift Voucher --}}
    @if ($category->gift)
    <x-gift-voucher />
    @endif

</x-layout>